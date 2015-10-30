<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "loan".
 *
 * @property integer $loan_id
 * @property string $wechat_id
 * @property integer $money
 * @property integer $duration
 * @property double $rate
 * @property integer $status
 * @property integer $start_at
 * @property integer $end_at
 * @property integer $created_at
 * @property string $updated_at
 *
 * @property User $wechat
 */
class Loan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['wechat_id', 'money', 'duration', 'rate', 'status', 'start_at', 'end_at', 'created_at'], 'required'],
            [['money', 'duration', 'status', 'start_at', 'end_at', 'created_at'], 'integer'],
            [['rate'], 'number'],
            [['updated_at'], 'safe'],
            [['wechat_id'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'loan_id' => '编号',
            'wechat_id' => '微信',
            'money' => '金额',
            'duration' => '周期',
            'rate' => '费率',
            'status' => '状态',
            'start_at' => '开始时间',
            'end_at' => '结束时间',
            'reviewer' => '审核人',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWechat()
    {
        return $this->hasOne(User::className(), ['wechat_id' => 'wechat_id']);
    }
}
