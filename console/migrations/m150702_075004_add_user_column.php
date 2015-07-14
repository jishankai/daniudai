<?php

use yii\db\Schema;
use yii\db\Migration;

class m150702_075004_add_user_column extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'verify_times', Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 3 AFTER bank_id');
        $this->addColumn('user', 'auth_code', Schema::TYPE_STRING . '(32) NOT NULL DEFAULT "" AFTER bank_id');

    }

    public function down()
    {
        $this->dropColumn('user', 'auth_code');
        $this->dropColumn('user', 'verify_times');
    }

}
