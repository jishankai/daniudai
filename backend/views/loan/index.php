<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "历史列表";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'wechat.name',
            'wechat.id',
            'wechat.mobile',
            'wechat.student.school.name',
            'wechat.student.school.depart',
            'wechat.student.grade',
            'money',
            'duration',
            'rate',
            'reviewer',
            //array('name'=>'status', 'value'=>'$data->status==0?"待申请":($data->status==1?"待审核":($data->status==2?"待放款":($data->status==3?"已放款":($data->status==4?"已还款":"被拒绝"))))', 'filter'=>array(0=>'待申请', 1=>'待审核', 2=>'待放款', 3=>'已放款', 4=>'已还款', -1=>'被拒绝')),
            'start_at:datetime',
            'end_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
