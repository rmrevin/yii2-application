<?php
/**
 * Facebook.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\modules\Account\models\User;

use frontend\modules\Account;

/**
 * Class Facebook
 * @package frontend\modules\Account\models\User
 *
 * @property integer $user_id
 * @property string $social_id
 */
class Facebook extends \yii\db\ActiveRecord
{

    /**
     * @return Account\models\queries\UserFacebookQuery
     */
    public static function find()
    {
        return new Account\models\queries\UserFacebookQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account_user_facebook}}';
    }
}