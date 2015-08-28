<?php

use yii\db\Schema;
use yii\db\Migration;

class m150828_073612_add_student_column extends Migration
{
    public function up()
    {
        $this->addColumn('student', 'mail', Schema::TYPE_STRING . '(45) NOT NULL DEFAULT "" AFTER grade');
    }

    public function down()
    {
        $this->dropColumn('student', 'mail');
    }
}
