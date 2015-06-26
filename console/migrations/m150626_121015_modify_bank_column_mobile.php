<?php

use yii\db\Schema;
use yii\db\Migration;

class m150626_121015_modify_bank_column_mobile extends Migration
{
    public function up()
    {
        $this->alterColumn('bank', 'mobile', Schema::TYPE_STRING . '(24) NOT NULL DEFAULT ""');
    }

    public function down()
    {
        $this->alterColumn('bank', 'mobile', Schema::TYPE_INTEGER . ' NOT NULL');
    }
}
