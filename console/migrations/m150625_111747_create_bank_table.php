<?php

use yii\db\Schema;
use yii\db\Migration;

class m150625_111747_create_bank_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%bank}}', [
            'card' => Schema::TYPE_INTEGER. ' NOT NULL',
            'name' => Schema::TYPE_STRING . '(45) NOT NULL',
            'mobile' => Schema::TYPE_INTEGER . ' NOT NULL',
            'cid' => Schema::TYPE_STRING . '(45) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`card`)',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%bank}}');
    }
}
