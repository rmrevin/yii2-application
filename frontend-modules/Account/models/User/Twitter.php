<?php
/**
 * Twitter.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\modules\Account\models\User;

use frontend\modules\Account;

/**
 * Class Twitter
 * @package frontend\modules\Account\models\User
 *
 * @property integer $user_id
 * @property string $social_id
 */
class Twitter extends \yii\db\ActiveRecord
{

    /**
     * @return Account\models\queries\UserTwitterQuery
     */
    public static function find()
    {
        return new Account\models\queries\UserTwitterQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account_user_twitter}}';
    }
}