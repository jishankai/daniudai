<?php

use yii\db\Schema;
use yii\db\Migration;

class m150626_120606_modify_bank_column extends Migration
{
    public function up()
    {
        $this->alterColumn('bank', 'card', Schema::TYPE_STRING . '(24) NOT NULL DEFAULT ""');
    }

    public function down()
    {
        $this->alterColumn('bank', 'card', Schema::TYPE_INTEGER . ' NOT NULL');
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
