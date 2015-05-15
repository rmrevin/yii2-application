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
 * @property boolean $deleted
 * @property string $token
 * @property string $auth_key
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @method User\queries\UserQuery hasMany($class, $link)
 * @method User\queries\UserQuery hasOne($class, $link)
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    use User\traits\UserSocialTrait;
    use User\traits\UserAvailableTrait;

    /** @var array */
    private $_access = [];

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
            [['name', 'login', 'avatar'], 'string', 'length' => [1, 255]],
            [['email'], 'email'],
            [['deleted'], 'boolean'],

            /** semantic validators */
            [['name', 'login'], 'required'],
            [['name', 'login', 'email', 'avatar'], 'filter', 'filter' => 'str_clean'],
            [['deleted'], 'in', 'range' => [self::NOT_DELETED, self::DELETED]],

            /** default values */
            [['deleted'], 'default', 'value' => self::NOT_DELETED],
        ];
    }

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
        return '{{%user}}';
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
                $Model->auth_key = Security()->generateRandomString();
                $Model->token = Security()->generateRandomString();
            }
        );
    }

    const NOT_DELETED = 0;
    const DELETED = 1;
}