<?php

use yii\db\Schema;
use yii\db\Migration;

class m150825_070415_add_user_column extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'ban', Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0 AFTER verify_times');
    }

    public function down()
    {
        $this->dropColumn('user', 'ban');
    }
}
