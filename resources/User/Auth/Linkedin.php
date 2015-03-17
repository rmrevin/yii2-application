<?php
/**
 * Linkedin.php
 * @author Revin Roman http://phptime.ru
 */

namespace resources\User\Auth;

/**
 * Class Linkedin
 * @package resources\User\Auth
 */
class Linkedin extends AbstractSocial
{

    /**
     * @return \resources\User\queries\UserLinkedinQuery
     */
    public static function find()
    {
        return new \resources\User\queries\UserLinkedinQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_auth_linkedin}}';
    }
}