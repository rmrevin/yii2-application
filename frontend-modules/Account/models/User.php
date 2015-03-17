<?php
/**
 * User.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\modules\Account\models;

use frontend\modules\Account;

/**
 * Class User
 * @package frontend\modules\Account\models
 *
 * @property integer $id
 * @property integer $github_id
 * @property string $login
 * @property string $name
 * @property string $email
 * @property string $avatar
 * @property boolean $deleted
 * @property string $token
 * @property string $auth_key
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $logged_at
 *
 * @method queries\UserQuery hasMany($class, $link)
 * @method queries\UserQuery hasOne($class, $link)
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    use Account\models\traits\UserAvailableTrait;

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
            [['github_id'], 'integer'],
            [['name', 'login', 'avatar'], 'string', 'length' => [1, 255]],
            [['email'], 'email'],
            [['deleted'], 'boolean'],

            /** semantic validators */
            [['github_id', 'name', 'login'], 'required'],
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
     * @param \yii\authclient\ClientInterface $Client
     * @throws \yii\base\NotSupportedException
     */
    public function appendClientAttributes(\yii\authclient\ClientInterface $Client)
    {
        $attributes = $Client->getUserAttributes();

        switch ($Client->getName()) {
            default:
                $attributes = null;
                break;
            case 'facebook':
                $attributes = [
                    'login' => $attributes['email'],
                    'name' => $attributes['name'],
                    'email' => $attributes['email'],
                ];
                break;
            case 'github':
                $name = $attributes['login'];
                if (isset($attributes['name']) && !empty($attributes['name'])) {
                    $name = $attributes['name'];
                }

                $email = null;
                if (isset($attributes['email']) && !empty($attributes['email'])) {
                    $email = $attributes['email'];
                }

                $avatar = null;
                if (isset($attributes['avatar_url']) && !empty($attributes['avatar_url'])) {
                    $avatar = $attributes['avatar_url'];
                }

                $attributes = [
                    'login' => $attributes['login'],
                    'name' => $name,
                    'email' => $email,
                    'avatar' => $avatar,
                ];
                break;
            case 'google':
                throw new \yii\base\NotSupportedException;
                break;
            case 'linkedin':
                throw new \yii\base\NotSupportedException;
                break;
            case 'live':
                throw new \yii\base\NotSupportedException;
                break;
            case 'twitter':
                throw new \yii\base\NotSupportedException;
                break;
            case 'vkontakte':
                throw new \yii\base\NotSupportedException;
                break;
            case 'yandex':
                throw new \yii\base\NotSupportedException;
                break;
        }

        if (!empty($attributes)) {
            $this->setAttributes($attributes);
        }
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
            ->byToken(XXTEA()->decrypt($token))
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
     * @return queries\UserQuery|\yii\db\ActiveQuery|\yii\db\ActiveQueryInterface
     */
    public static function find()
    {
        return new queries\UserQuery(get_called_class());
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
            User::ROLE_ADMIN => \Yii::t('app', 'Administrator'),
            User::ROLE_MANAGER => \Yii::t('app', 'Manager'),
            User::ROLE_USER => \Yii::t('app', 'User'),
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

    const ROLE_USER = 'user';
    const ROLE_MANAGER = 'manager';
    const ROLE_ADMIN = 'admin';
}