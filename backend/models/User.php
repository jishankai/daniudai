<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $wechat_id
 * @property string $name
 * @property string $id
 * @property integer $mobile
 * @property string $bank
 * @property integer $bank_id
 * @property integer $created_at
 * @property string $updated_at
 *
 * @property Loan $loan
 * @property Student $student
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wechat_id', 'name', 'id', 'mobile', 'bank', 'bank_id', 'created_at'], 'required'],
            [['mobile', 'bank_id', 'created_at'], 'integer'],
            [['updated_at'], 'safe'],
            [['wechat_id', 'name', 'bank'], 'string', 'max' => 45],
            [['id'], 'string', 'max' => 18]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wechat_id' => 'Wechat ID',
            'name' => 'Name',
            'id' => 'ID',
            'mobile' => 'Mobile',
            'bank' => 'Bank',
            'bank_id' => 'Bank ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoan()
    {
        return $this->hasOne(Loan::className(), ['wechat_id' => 'wechat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['wechat_id' => 'wechat_id']);
    }
}
