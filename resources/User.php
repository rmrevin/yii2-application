<?php
/**
 * User.php
 * @author Revin Roman http://phptime.ru
 */

namespace resources;

/**
 * Class User
 * @package resources
 *
 * @property integer $id
 * @property string $login
 * @property string $name
 * @property string $email
 * @property string $avatar
 * @property string $password_hash
 * @property string $token
 * @property string $auth_key
 * @property integer $created_at
 * @property integer $updated_at
 * @property boolean $activated
 * @property boolean $deleted
 *
 * @method User\queries\UserQuery hasMany($class, $link)
 * @method User\queries\UserQuery hasOne($class, $link)
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    use \resources\User\traits\UserSocialTrait;
    use \common\traits\ActiveRecord\ActivationTrait;
    use \common\traits\ActiveRecord\SoftDeleteTrait;

    /** @var string */
    public $password;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->events();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /** type validators */
            [['name', 'login', 'avatar', 'password', 'password_hash'], 'string'],
            [['email'], 'email'],
            [['activated', 'deleted'], 'boolean'],

            /** semantic validators */
            [['name', 'login'], 'required'],
            [['name', 'login', 'email', 'avatar'], 'filter', 'filter' => 'str_clean'],
            [['activated'], 'in', 'range' => [self::NOT_ACTIVATED, self::ACTIVATED]],
            [['deleted'], 'in', 'range' => [self::NOT_DELETED, self::DELETED]],

            /** default values */
            [['activated'], 'default', 'value' => self::NOT_ACTIVATED],
            [['deleted'], 'default', 'value' => self::NOT_DELETED],
        ];
    }

    /**
     * @return bool|string
     */
    public function isAvailable()
    {
        $result = true;

        switch ($this->activated) {
            default:
            case \resources\User::NOT_ACTIVATED:
                $result = 'not-activated';
                break;
            case \resources\User::ACTIVATED:
                break;
        }

        switch ($this->deleted) {
            default:
            case \resources\User::DELETED:
                $result = 'deleted';
                break;
            case \resources\User::NOT_DELETED:
                break;
        }

        return $result;
    }

    /** @var array */
    private $_access = [];

    /**
     * @param string $permissionName
     * @param array $params
     * @param boolean $allowCaching
     * @return boolean
     */
    public function can($permissionName, $params = [], $allowCaching = true)
    {
        if ($allowCaching && empty($params) && isset($this->_access[$permissionName])) {
            return $this->_access[$permissionName];
        }
        $access = AuthManager()->checkAccess($this->id, $permissionName, $params);
        if ($allowCaching && empty($params)) {
            $this->_access[$permissionName] = $access;
        }

        return $access;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::find()
            ->byId($id)
            ->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()
            ->byToken($token)
            ->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Security()->validatePassword($password, $this->password_hash);
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        $result = [];

        $roles = static::getAllRoles();
        $Assignments = AuthManager()->getAssignments($this->id);

        foreach (array_keys($Assignments) as $role) {
            $result[$role] = $roles[$role];
        }

        unset($result['user']);

        return $result;
    }

    /**
     * @return \resources\User\queries\UserQuery
     */
    public static function find()
    {
        return new \resources\User\queries\UserQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account_user}}';
    }

    /**
     * @return array
     */
    public static function getAllRoles()
    {
        return [
            \frontend\Permissions::ROLE_ADMIN => \Yii::t('user', 'Администратор'),
            \frontend\Permissions::ROLE_MANAGER => \Yii::t('user', 'Менеджер'),
            \frontend\Permissions::ROLE_USER => \Yii::t('user', 'Пользователь'),
        ];
    }

    private function events()
    {
        $this->on(
            self::EVENT_BEFORE_INSERT,
            function (\yii\base\ModelEvent $Event) {
                /** @var self $Model */
                $Model = $Event->sender;
                $Model->password_hash = Security()->generatePasswordHash($this->password);
                $Model->auth_key = Security()->generateRandomString();
                $Model->token = Security()->generateRandomString();
            }
        );

        $this->on(
            self::EVENT_BEFORE_UPDATE,
            function (\yii\base\ModelEvent $Event) {
                /** @var self $Model */
                $Model = $Event->sender;
                if (!empty($this->password)) {
                    $Model->password_hash = Security()->generatePasswordHash($this->password);
                }
            }
        );
    }

    const NOT_ACTIVATED = 0;
    const ACTIVATED = 1;

    const NOT_DELETED = 0;
    const DELETED = 1;
}