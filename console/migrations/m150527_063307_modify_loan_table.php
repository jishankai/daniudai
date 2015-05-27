<?php

use yii\db\Schema;
use yii\db\Migration;

class m150527_063307_modify_loan_table extends Migration
{
    public function safeUp()
    {
        $this->dropPrimaryKey('PRIMARY', 'loan');
        $this->addColumn('loan', 'loan_id', Schema::TYPE_INTEGER . ' NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');
    }

    public function safeDown()
    {
        $this->dropColumn('loan', 'loan_id');
        $this->addPrimaryKey('PRIMARY', 'loan', 'wechat_id');
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
