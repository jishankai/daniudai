<?php

use yii\db\Schema;
use yii\db\Migration;

class m150528_135607_modify_user_table extends Migration
{
    public function up()
    {
        $this->alterColumn('user', 'mobile', Schema::TYPE_STRING . '(11) NOT NULL DEFAULT ""');
        $this->alterColumn('user', 'bank_id', Schema::TYPE_STRING . '(24) NOT NULL DEFAULT ""');
    }

    public function down()
    {
        $this->alterColumn('user', 'bank_id', Schema::TYPE_INTEGER . '(20) NOT NULL DEFAULT 0');
        $this->alterColumn('user', 'mobile', Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT 0');
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
