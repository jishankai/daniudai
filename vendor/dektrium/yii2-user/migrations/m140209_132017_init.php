<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use dektrium\user\migrations\Migration;
use yii\db\Schema;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class m140209_132017_init extends Migration
{
    public function up()
    {
        $this->createTable('{{%admin_user}}', [
            'id' => Schema::TYPE_PK,
            'username'             => Schema::TYPE_STRING . '(25) NOT NULL',
            'email'                => Schema::TYPE_STRING . '(255) NOT NULL',
            'password_hash'        => Schema::TYPE_STRING . '(60) NOT NULL',
            'auth_key'             => Schema::TYPE_STRING . '(32) NOT NULL',
            'confirmation_token'   => Schema::TYPE_STRING . '(32)',
            'confirmation_sent_at' => Schema::TYPE_INTEGER,
            'confirmed_at'         => Schema::TYPE_INTEGER,
            'unconfirmed_email'    => Schema::TYPE_STRING . '(255)',
            'recovery_token'       => Schema::TYPE_STRING . '(32)',
            'recovery_sent_at'     => Schema::TYPE_INTEGER,
            'blocked_at'           => Schema::TYPE_INTEGER,
            'registered_from'      => Schema::TYPE_INTEGER,
            'logged_in_from'       => Schema::TYPE_INTEGER,
            'logged_in_at'         => Schema::TYPE_INTEGER,
            'created_at'           => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'           => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $this->tableOptions);

        $this->createIndex('user_unique_username', '{{%admin_user}}', 'username', true);
        $this->createIndex('user_unique_email', '{{%admin_user}}', 'email', true);
        $this->createIndex('user_confirmation', '{{%admin_user}}', 'id, confirmation_token', true);
        $this->createIndex('user_recovery', '{{%admin_user}}', 'id, recovery_token', true);

        $this->createTable('{{%profile}}', [
            'user_id'        => Schema::TYPE_INTEGER . ' PRIMARY KEY',
            'name'           => Schema::TYPE_STRING . '(255)',
            'public_email'   => Schema::TYPE_STRING . '(255)',
            'gravatar_email' => Schema::TYPE_STRING . '(255)',
            'gravatar_id'    => Schema::TYPE_STRING . '(32)',
            'location'       => Schema::TYPE_STRING . '(255)',
            'website'        => Schema::TYPE_STRING . '(255)',
            'bio'            => Schema::TYPE_TEXT,
        ], $this->tableOptions);

        $this->addForeignKey('fk_user_profile', '{{%profile}}', 'user_id', '{{%admin_user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%profile}}');
        $this->dropTable('{{%admin_user}}');
    }
}
