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
     * @param \yii\authclient\ClientInterface $Client
     * @throws \yii\base\NotSupportedException
     */
    public function appendClientAttributes(\yii\authclient\ClientInterface $Client)
    {
        $attributes = $Client->getUserAttributes();
//        dump($attributes);die();

        switch ($Client->getId()) {
            default:
                $attributes = null;
                break;
            case 'facebook':
                $name = null;
                if (isset($attributes['name']) && !empty($attributes['name'])) {
                    $name = $attributes['name'];
                }

                $email = null;
                if (isset($attributes['email']) && !empty($attributes['email'])) {
                    $email = $attributes['email'];
                }

                $attributes = [
                    'login' => $email,
                    'name' => $name,
                    'email' => $email,
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
                $name = $attributes['displayName'];
                if (isset($attributes['name']['familyName']) && !empty($attributes['name']['familyName'])) {
                    $name = $attributes['name']['familyName'] . ' ';
                    if (isset($attributes['name']['givenName']) && !empty($attributes['name']['givenName'])) {
                        $name .= $attributes['name']['givenName'];
                    }
                }

                $email = null;
                if (isset($attributes['emails']) && !empty($attributes['emails'])) {
                    $email = array_shift($attributes['emails'])['value'];
                }

                $avatar = null;
                if (isset($attributes['image']) && !empty($attributes['image'])) {
                    $avatar = $attributes['image']['url'];
                }

                $attributes = [
                    'login' => empty($email) ? ('google-' . $attributes['id']) : $email,
                    'name' => trim($name),
                    'email' => $email,
                    'avatar' => $avatar,
                ];
                break;
            case 'linkedin':
                throw new \yii\base\NotSupportedException;
                break;
            case 'live':
                throw new \yii\base\NotSupportedException;
                break;
            case 'twitter':
                $name = null;
                if (isset($attributes['name']) && !empty($attributes['name'])) {
                    $name = $attributes['name'];
                }

                $avatar = null;
                if (isset($attributes['profile_image_url']) && !empty($attributes['profile_image_url'])) {
                    $avatar = $attributes['profile_image_url'];
                }
                if (isset($attributes['profile_image_url_https']) && !empty($attributes['profile_image_url_https'])) {
                    $avatar = $attributes['profile_image_url_https'];
                }

                $attributes = [
                    'login' => $attributes['screen_name'],
                    'name' => $name,
                    'avatar' => $avatar,
                ];
                break;
            case 'vkontakte':
                $name = null;
                if (isset($attributes['last_name']) && !empty($attributes['last_name'])) {
                    $name = $attributes['last_name'] . ' ';
                }
                if (isset($attributes['first_name']) && !empty($attributes['first_name'])) {
                    $name .= $attributes['first_name'];
                }

                $avatar = null;
                if (isset($attributes['photo']) && !empty($attributes['photo'])) {
                    $avatar = $attributes['photo'];
                }

                $attributes = [
                    'login' => $attributes['screen_name'],
                    'name' => trim($name),
                    'avatar' => $avatar,
                ];
                break;
            case 'yandex':
                $name = null;
                if (isset($attributes['last_name']) && !empty($attributes['last_name'])) {
                    $name = $attributes['last_name'] . ' ';
                }
                if (isset($attributes['first_name']) && !empty($attributes['first_name'])) {
                    $name .= $attributes['first_name'];
                }
                if (isset($attributes['real_name']) && !empty($attributes['real_name'])) {
                    $name = $attributes['real_name'];
                }

                $email = null;
                if (isset($attributes['default_email']) && !empty($attributes['default_email'])) {
                    $email = $attributes['default_email'];
                }

                $avatar = null;
                // @todo implement yandex avatar $attributes['default_avatar_id']

                $attributes = [
                    'login' => $attributes['login'],
                    'name' => trim($name),
                    'email' => $email,
                ];
                break;
        }

//        dump($attributes);die();
        if (!empty($attributes)) {
            $this->setAttributes($attributes);
        }
    }

    /**
     * @param \yii\authclient\ClientInterface $Client
     * @return bool
     */
    public function createSocialLink(\yii\authclient\ClientInterface $Client)
    {
        $attributes = $Client->getUserAttributes();

        switch ($Client->getId()) {
            default:
                $Auth = null;
                break;
            case 'facebook':
                $Auth = new \resources\User\Auth\Facebook(['user_id' => $this->id, 'social_id' => $attributes['id']]);
                break;
            case 'github':
                $Auth = new \resources\User\Auth\Github(['user_id' => $this->id, 'social_id' => $attributes['id']]);
                break;
            case 'google':
                $Auth = new \resources\User\Auth\Google(['user_id' => $this->id, 'social_id' => $attributes['id']]);
                break;
            case 'linkedin':
                $Auth = new \resources\User\Auth\Linkedin(['user_id' => $this->id, 'social_id' => $attributes['id']]);
                break;
            case 'live':
                $Auth = new \resources\User\Auth\Live(['user_id' => $this->id, 'social_id' => $attributes['id']]);
                break;
            case 'twitter':
                $Auth = new \resources\User\Auth\Twitter(['user_id' => $this->id, 'social_id' => $attributes['id']]);
                break;
            case 'vkontakte':
                $Auth = new \resources\User\Auth\Vkontakte(['user_id' => $this->id, 'social_id' => $attributes['id']]);
                break;
            case 'yandex':
                $Auth = new \resources\User\Auth\Yandex(['user_id' => $this->id, 'social_id' => $attributes['id']]);
                break;
        }

        $Auth->save();

        return $Auth;
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
        throw new \yii\base\NotSupportedException;
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
            User::ROLE_ADMIN => \Yii::t('user', 'Администратор'),
            User::ROLE_MANAGER => \Yii::t('user', 'Менеджер'),
            User::ROLE_USER => \Yii::t('user', 'Пользователь'),
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