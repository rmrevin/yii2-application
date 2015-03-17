<?php
/**
 * Google.php
 * @author Revin Roman http://phptime.ru
 */

namespace resources\User\Auth;

/**
 * Class Google
 * @package resources\User\Auth
 */
class Google extends AbstractSocial
{

    /**
     * @return \resources\User\queries\UserGoogleQuery
     */
    public static function find()
    {
        return new \resources\User\queries\UserGoogleQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_auth_google}}';
    }
}