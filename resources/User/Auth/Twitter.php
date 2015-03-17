<?php
/**
 * Twitter.php
 * @author Revin Roman http://phptime.ru
 */

namespace resources\User\Auth;

/**
 * Class Twitter
 * @package resources\User\Auth
 */
class Twitter extends AbstractSocial
{

    /**
     * @return \resources\User\queries\UserTwitterQuery
     */
    public static function find()
    {
        return new \resources\User\queries\UserTwitterQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_auth_twitter}}';
    }
}