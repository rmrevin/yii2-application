<?php
/**
 * AuthResponse.php
 * @author Revin Roman http://phptime.ru
 */

namespace resources\User\Auth;

/**
 * Class AuthResponse
 * @package resources\User\Auth
 *
 * @property integer $id
 * @property integer $received_at
 * @property string $client
 * @property string $response
 * @property string $result
 * @property string $user_ip
 */
class Response extends \yii\db\ActiveRecord
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
     * @return \resources\User\queries\UserAuthResponseQuery
     */
    public static function find()
    {
        return new \resources\User\queries\UserAuthResponseQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_auth_response}}';
    }
}