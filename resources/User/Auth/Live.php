<?php
/**
 * Live.php
 * @author Revin Roman http://phptime.ru
 */

namespace resources\User\Auth;

/**
 * Class Live
 * @package resources\User\Auth
 */
class Live extends AbstractSocial
{

    /**
     * @return \resources\User\queries\UserLiveQuery
     */
    public static function find()
    {
        return new \resources\User\queries\UserLiveQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_auth_live}}';
    }
}