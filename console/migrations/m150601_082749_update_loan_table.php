<?php

use yii\db\Schema;
use yii\db\Migration;

class m150601_082749_update_loan_table extends Migration
{
    public function up()
    {
        $this->addColumn('loan', 'reviewer', Schema::TYPE_STRING . '(45) NOT NULL DEFAULT "" AFTER status');
        $pku101_supporter = Yii::$app->params['pku101_supporter'];
        $pku102_supporter = Yii::$app->params['pku102_supporter'];
        Yii::$app->db->createCommand("UPDATE loan l, student s SET reviewer={$pku101_supporter} WHERE l.wechat_id=s.wechat_id AND s.school_id LIKE '101%'")->execute();        
        Yii::$app->db->createCommand("UPDATE loan l, student s SET reviewer={$pku102_supporter} WHERE l.wechat_id=s.wechat_id AND s.school_id LIKE '102%'")->execute();        
    }

    public function down()
    {
        $this->dropColumn('loan', 'reviewer');
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
