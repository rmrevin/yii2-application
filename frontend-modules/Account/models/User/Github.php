<?php
/**
 * Github.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\modules\Account\models\User;

use frontend\modules\Account;

/**
 * Class Github
 * @package frontend\modules\Account\models\User
 *
 * @property integer $user_id
 * @property string $social_id
 */
class Github extends \yii\db\ActiveRecord
{

    /**
     * @return Account\models\queries\UserGithubQuery
     */
    public static function find()
    {
        return new Account\models\queries\UserGithubQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account_user_github}}';
    }
}