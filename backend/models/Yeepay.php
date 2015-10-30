<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "yeepay".
 *
 * @property string $order_id
 * @property string $wechat_id
 * @property integer $fee
 * @property integer $status
 * @property integer $loan_id
 * @property integer $created_at
 * @property string $updated_at
 */
class Yeepay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yeepay';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['order_id', 'wechat_id', 'fee', 'status', 'loan_id', 'created_at'], 'required'],
            [['fee', 'status', 'loan_id', 'created_at'], 'integer'],
            [['updated_at'], 'safe'],
            [['order_id', 'wechat_id'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => '编号',
            'wechat_id' => '微信',
            'fee' => '还款额',
            'status' => '状态',
            'loan_id' => '借款编号',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
