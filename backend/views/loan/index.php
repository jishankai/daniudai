<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use backend\models\User;
use backend\models\School;

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
            [
                'class'=>'kartik\grid\SerialColumn',
                'contentOptions'=>['class'=>'kartik-sheet-style'],
                'width'=>'5%',
                'vAlign'=>'middle',
                'header'=>'',
                'headerOptions'=>['class'=>'kartik-sheet-style'],
                'pageSummary'=>'总计',
            ],
            [
                'attribute'=>'wechat.name',
                'vAlign'=>'middle',
                'pageSummary'=>true,
                'pageSummaryFunc'=>GridView::F_COUNT,
            ],
            [
                'attribute'=>'wechat.id',
                'vAlign'=>'middle',
            ],
            [
                'attribute'=>'wechat.mobile',
                'vAlign'=>'middle',
            ],
            [
                'attribute'=>'wechat.bank',
                'vAlign'=>'middle',
            ],
            [
                'attribute'=>'wechat.bank_id',
                'vAlign'=>'middle',
            ],
            [
                'attribute'=>'school',
                'vAlign'=>'middle',
                //'filter'=>ArrayHelper::map(School::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
            ],
            [
                'attribute'=>'wechat.student.school.depart',
                'vAlign'=>'middle',
            ],
            [
                'attribute'=>'wechat.student.grade',
                'vAlign'=>'middle',
            ],
            [
                'attribute'=>'money',
                'vAlign'=>'middle',
                'pageSummary'=>true,
            ],
            [
                'attribute'=>'duration',
                'vAlign'=>'middle',
                'width'=>'8%',
                'filter'=>[100=>100,200=>200,300=>300],
                'format'=>'raw',
            ],
            [
                'attribute'=>'rate',
                'vAlign'=>'middle',
            ],
            [
                'attribute'=>'reviewer',
                'vAlign'=>'middle',
                'width'=>'8%',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->reviewer==''?'':User::findOne($model->reviewer)->name;
                },
                //'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(User::find()->where(['wechat_id' => Yii::$app->params['supporters']])->asArray()->all(), 'wechat_id', 'name'),
                'format'=>'raw'
            ],
            [
                'attribute'=>'status',
                'vAlign'=>'middle',
                'width'=>'8%',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->status==0?"待申请":($model->status==1?"待审核":($model->status==2?"待放款":($model->status==3?"已放款":($model->status==4?"已还款":"被拒绝"))));
                },
                'filter'=>[0=>'待申请', 1=>'待审核', 2=>'待放款', 3=>'已放款', 4=>'已还款', -1=>'被拒绝'],
                'format'=>'raw',
            ],
            'start_at:date',
            'end_at:date'
            // [
            //     'attribute'=>'start_at:date',
            //     'vAlign'=>'middle',
            //     'filterType'=>GridView::FILTER_DATE_RANGE,
            // ],
            // [
            //     'attribute'=>'end_at:date',
            //     'vAlign'=>'middle',
            //     'filterType'=>GridView::FILTER_DATE_RANGE,
            // ]
        ],
        'responsive'=>true,
        'hover'=>true,
        // 'export'=>false,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'panel'=>[
            'type'=>GridView::TYPE_PRIMARY,
            'heading'=>"历史列表",
        ],
        'toolbar'=> [
            '{export}',
            '{toggleData}',
        ],
        // set export properties
        'export'=>[
            'fontAwesome'=>true
        ],
        'showPageSummary'=>true,
    ]); ?>

</div>
