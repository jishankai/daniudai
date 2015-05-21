<?php

use yii\db\Schema;
use yii\db\Migration;

class m150521_080839_create_user_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'wechat_id' => Schema::TYPE_STRING. '(45) NOT NULL',
            'name' => Schema::TYPE_STRING . '(45) NOT NULL',
            'id' => Schema::TYPE_STRING . '(18) NOT NULL',
            'mobile' => Schema::TYPE_INTEGER . ' NOT NULL',
            'bank' => Schema::TYPE_STRING . '(45) NOT NULL',
            'bank_id' => Schema::TYPE_INTEGER . '(20) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`wechat_id`)',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
