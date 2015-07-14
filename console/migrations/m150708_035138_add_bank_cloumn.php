<?php

use yii\db\Schema;
use yii\db\Migration;

class m150708_035138_add_bank_cloumn extends Migration
{
    public function safeUp()
    {
        $this->dropPrimaryKey('PRIMARY', 'bank');
        $this->addColumn('bank', 'wechat_id', Schema::TYPE_STRING . ' NOT NULL PRIMARY KEY FIRST');
    }

    public function safeDown()
    {
        $this->dropColumn('bank', 'wechat_id');
        $this->addPrimaryKey('PRIMARY', 'bank', 'card');
    }

}
