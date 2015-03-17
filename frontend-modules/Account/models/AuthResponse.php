<?php
/**
 * AuthResponse.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\modules\Account\models;

/**
 * Class AuthResponse
 * @package frontend\modules\Account\models
 *
 * @property integer $id
 * @property integer $received_at
 * @property string $client
 * @property string $response
 * @property string $result
 * @property string $user_ip
 */
class AuthResponse extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /** type validators */
            [['received_at', 'user_ip'], 'integer'],
            [['client', 'response', 'result'], 'string'],

            /** semantic validators */
            [['received_at', 'client', 'response', 'result', 'user_ip'], 'required'],

            /** default values */
            [['received_at'], 'default', 'value' => time()],
            [['user_ip'], 'default', 'value' => ip2long(Request()->userIP)],
        ];
    }

    /**
     * @return queries\AuthResponseQuery|\yii\db\ActiveQuery|\yii\db\ActiveQueryInterface
     */
    public static function find()
    {
        return new queries\AuthResponseQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account_auth_response}}';
    }
}