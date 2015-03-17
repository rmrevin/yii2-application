<?php
/**
 * Vkontakte.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\modules\Account\models\User;

use frontend\modules\Account;

/**
 * Class Vkontakte
 * @package frontend\modules\Account\models\User
 *
 * @property integer $user_id
 * @property string $social_id
 */
class Vkontakte extends \yii\db\ActiveRecord
{

    /**
     * @return Account\models\queries\UserVkontakteQuery
     */
    public static function find()
    {
        return new Account\models\queries\UserVkontakteQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account_user_vkontakte}}';
    }
}