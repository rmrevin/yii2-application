<?php
/**
 * Yandex.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\modules\Account\models\User;

use frontend\modules\Account;

/**
 * Class Yandex
 * @package frontend\modules\Account\models\User
 *
 * @property integer $user_id
 * @property string $social_id
 */
class Yandex extends \yii\db\ActiveRecord
{

    /**
     * @return Account\models\queries\UserYandexQuery
     */
    public static function find()
    {
        return new Account\models\queries\UserYandexQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account_user_yandex}}';
    }
}