<?php

use yii\db\Schema;
use yii\db\Migration;

class m150521_081048_create_student_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%student}}', [
            'wechat_id' => Schema::TYPE_STRING. '(45) NOT NULL',
            'stu_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'school_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'dorm' => Schema::TYPE_STRING . '(45) NOT NULL',
            'grade' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`wechat_id`)',
            'KEY `FK_STU&SCH` (`school_id`)',
            'CONSTRAINT `FK_STU&SCH` FOREIGN KEY (`school_id`) REFERENCES `school` (`school_id`) ON DELETE CASCADE',
            'KEY `FK_STU&USER` (`wechat_id`)',
            'CONSTRAINT `FK_STU&USER` FOREIGN KEY (`wechat_id`) REFERENCES `user` (`wechat_id`) ON DELETE CASCADE',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%student}}');
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
