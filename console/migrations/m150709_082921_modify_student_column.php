<?php

use yii\db\Schema;
use yii\db\Migration;

class m150709_082921_modify_student_column extends Migration
{
    public function up()
    {
        $this->alterColumn('student', 'stu_id', Schema::TYPE_STRING . '(12) NOT NULL DEFAULT ""');
    }

    public function down()
    {
        $this->alterColumn('student', 'stu_id', Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0');
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
