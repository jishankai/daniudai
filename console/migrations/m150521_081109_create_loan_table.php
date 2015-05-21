<?php

use yii\db\Schema;
use yii\db\Migration;

class m150521_081109_create_loan_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%loan}}', [
            'wechat_id' => Schema::TYPE_STRING. '(45) NOT NULL',
            'money' => Schema::TYPE_INTEGER . ' NOT NULL',
            'duration' => Schema::TYPE_INTEGER . ' NOT NULL',
            'rate' => Schema::TYPE_FLOAT . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'start_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'end_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`wechat_id`)',
            'KEY `FK_LOAN&USER` (`wechat_id`)',
            'CONSTRAINT `FK_LOAN&USER` FOREIGN KEY (`wechat_id`) REFERENCES `user` (`wechat_id`) ON DELETE CASCADE',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%loan}}');
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
