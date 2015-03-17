<?php
/**
 * Linkedin.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\modules\Account\models\User;

use frontend\modules\Account;

/**
 * Class Linkedin
 * @package frontend\modules\Account\models\User
 *
 * @property integer $user_id
 * @property string $social_id
 */
class Linkedin extends \yii\db\ActiveRecord
{

    /**
     * @return Account\models\queries\UserLinkedinQuery
     */
    public static function find()
    {
        return new Account\models\queries\UserLinkedinQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account_user_linkedin}}';
    }
}