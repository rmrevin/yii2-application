<?php
/**
 * Yandex.php
 * @author Revin Roman http://phptime.ru
 */

namespace resources\User\Auth;

/**
 * Class Yandex
 * @package resources\User\Auth
 */
class Yandex extends AbstractSocial
{

    /**
     * @return \resources\User\queries\UserYandexQuery
     */
    public static function find()
    {
        return new \resources\User\queries\UserYandexQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_auth_yandex}}';
    }
}