<?php
/**
 * Google.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\modules\Account\models\User;

use frontend\modules\Account;

/**
 * Class Google
 * @package frontend\modules\Account\models\User
 *
 * @property integer $user_id
 * @property string $social_id
 */
class Google extends \yii\db\ActiveRecord
{

    /**
     * @return Account\models\queries\UserGoogleQuery
     */
    public static function find()
    {
        return new Account\models\queries\UserGoogleQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account_user_google}}';
    }
}