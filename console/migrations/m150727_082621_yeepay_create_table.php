<?php

use yii\db\Schema;
use yii\db\Migration;

class m150727_082621_yeepay_create_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%yeepay}}', [
            'order_id' => Schema::TYPE_STRING. '(45) NOT NULL',
            'wechat_id' => Schema::TYPE_STRING. '(45) NOT NULL',
            'fee' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'loan_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`order_id`)',
            'KEY `FK_YEEPAY&LOAN` (`loan_id`)',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%yeepay}}');
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
