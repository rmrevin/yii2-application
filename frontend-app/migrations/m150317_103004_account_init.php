<?php

use yii\db\mysql\Schema;

class m150317_103004_account_init extends \common\components\Migration
{

    static $socials = [];

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
                'password_hash' => Schema::TYPE_STRING,
                'token' => Schema::TYPE_STRING . '(32) NOT NULL',
                'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'activated' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0',
                'deleted' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0',
            ]
        );

        $this->createIndex('idx_email', '{{%account_user}}', ['email']);
        $this->createIndex('idx_token', '{{%account_user}}', ['token']);
        $this->createIndex('idx_auth_key', '{{%account_user}}', ['auth_key']);
        $this->createIndex('idx_activated', '{{%account_user}}', ['activated']);
        $this->createIndex('idx_deleted', '{{%account_user}}', ['deleted']);

        if (!empty(static::$socials)) {
            $this->createTable('{{%account_user_auth_response}}', [
                'id' => Schema::TYPE_PK,
                'received_at' => Schema::TYPE_INTEGER,
                'client' => Schema::TYPE_STRING,
                'response' => Schema::TYPE_TEXT,
                'result' => Schema::TYPE_TEXT,
                'user_ip' => Schema::TYPE_BIGINT,
            ]);

            $this->createIndex('idx_received_at', '{{%account_user_auth_response}}', ['received_at']);

            foreach (static::$socials as $social) {
                $this->createTable('{{%account_user_auth_' . $social . '}}', [
                    'user_id' => Schema::TYPE_INTEGER,
                    'social_id' => Schema::TYPE_STRING,
                    'PRIMARY KEY (user_id,social_id)',
                    'FOREIGN KEY (user_id) REFERENCES {{%account_user}} (id) ON DELETE CASCADE ON UPDATE CASCADE',
                ]);
            }
        }
    }

    public function safeDown()
    {
        if (!empty(static::$socials)) {
            foreach (static::$socials as $social) {
                $this->dropTable('{{%account_user_auth_' . $social . '}}');
            }

            $this->dropTable('{{%account_user_auth_response}}');
        }

        $this->dropTable('{{%account_user}}');
    }
}