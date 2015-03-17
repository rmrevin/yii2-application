<?php

use yii\db\mysql\Schema;

class m150317_103004_account_init extends \common\components\Migration
{

    static $socials = ['facebook', 'github', 'google', 'linkedin', 'live', 'twitter', 'vkontakte', 'yandex'];

    public function safeUp()
    {
        $this->createTable(
            '{{%account_user}}',
            [
                'id' => Schema::TYPE_PK,
                'login' => Schema::TYPE_STRING,
                'name' => Schema::TYPE_STRING,
                'email' => Schema::TYPE_STRING,
                'avatar' => Schema::TYPE_STRING,
                'deleted' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0',
                'token' => Schema::TYPE_STRING . '(32) NOT NULL',
                'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            ]
        );

        $this->createIndex('idx_email', '{{%account_user}}', 'email');
        $this->createIndex('idx_token', '{{%account_user}}', 'token');
        $this->createIndex('idx_auth_key', '{{%account_user}}', 'auth_key');

        $this->createTable('{{%account_auth_response}}', [
            'id' => Schema::TYPE_PK,
            'received_at' => Schema::TYPE_INTEGER,
            'client' => Schema::TYPE_STRING,
            'response' => Schema::TYPE_TEXT,
            'result' => Schema::TYPE_TEXT,
            'user_ip' => Schema::TYPE_BIGINT,
        ]);

        $this->createIndex('idx_received_at', '{{%account_auth_response}}', ['received_at']);

        foreach (static::$socials as $social) {
            $this->createTable('{{%account_user_' . $social . '}}', [
                'user_id' => Schema::TYPE_INTEGER,
                'social_id' => Schema::TYPE_STRING,
                'PRIMARY KEY ([[user_id]],[[social_id]])',
            ]);

            $this->addForeignKey(
                'fkey_account_user_' . $social . '_user_id_account_user',
                '{{%account_user_' . $social . '}}', 'user_id',
                '{{%account_user}}', 'id',
                'CASCADE', 'CASCADE'
            );
        }
    }

    public function safeDown()
    {
        foreach (static::$socials as $social) {
            $this->dropForeignKey('fkey_account_user_' . $social . '_user_id_account_user', '{{%account_user_' . $social . '}}');
            $this->dropTable('{{%account_user_' . $social . '}}');
        }

        $this->dropTable('{{%account_auth_response}}');
        $this->dropTable('{{%account_user}}');
    }
}