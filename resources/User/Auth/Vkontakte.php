<?php
/**
 * Vkontakte.php
 * @author Revin Roman http://phptime.ru
 */

namespace resources\User\Auth;

/**
 * Class Vkontakte
 * @package resources\User\Auth
 */
class Vkontakte extends AbstractSocial
{

    /**
     * @return \resources\User\queries\UserVkontakteQuery
     */
    public static function find()
    {
        return new \resources\User\queries\UserVkontakteQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_auth_vkontakte}}';
    }
}