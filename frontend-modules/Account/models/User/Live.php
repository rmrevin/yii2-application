<?php
/**
 * Live.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\modules\Account\models\User;

use frontend\modules\Account;

/**
 * Class Live
 * @package frontend\modules\Account\models\User
 *
 * @property integer $user_id
 * @property string $social_id
 */
class Live extends \yii\db\ActiveRecord
{

    /**
     * @return Account\models\queries\UserLiveQuery
     */
    public static function find()
    {
        return new Account\models\queries\UserLiveQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account_user_live}}';
    }
}