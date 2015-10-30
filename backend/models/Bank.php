<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property string $wechat_id
 * @property string $card
 * @property string $name
 * @property string $mobile
 * @property string $cid
 * @property integer $created_at
 * @property string $updated_at
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['wechat_id', 'name', 'cid', 'created_at'], 'required'],
            [['created_at'], 'integer'],
            [['updated_at'], 'safe'],
            [['wechat_id'], 'string', 'max' => 255],
            [['card', 'mobile'], 'string', 'max' => 24],
            [['name', 'cid'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wechat_id' => '微信',
            'card' => '卡号',
            'name' => '姓名',
            'mobile' => '电话',
            'cid' => '身份证',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
