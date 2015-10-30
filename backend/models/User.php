<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $wechat_id
 * @property string $name
 * @property string $id
 * @property string $mobile
 * @property string $bank
 * @property string $bank_id
 * @property string $auth_code
 * @property integer $verify_times
 * @property integer $ban
 * @property integer $created_at
 * @property string $updated_at
 *
 * @property Loan[] $loans
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
            //[['wechat_id', 'name', 'id', 'bank', 'created_at'], 'required'],
            [['verify_times', 'ban', 'created_at'], 'integer'],
            [['updated_at'], 'safe'],
            [['wechat_id', 'name', 'bank'], 'string', 'max' => 45],
            [['id'], 'string', 'max' => 18],
            [['mobile'], 'string', 'max' => 11],
            [['bank_id'], 'string', 'max' => 24],
            [['auth_code'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wechat_id' => '微信',
            'name' => '姓名',
            'id' => '身份证',
            'mobile' => '电话',
            'bank' => '银行',
            'bank_id' => '卡号',
            'auth_code' => '密码',
            'verify_times' => '剩余验证次数',
            'ban' => '黑名单',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(Loan::className(), ['wechat_id' => 'wechat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['wechat_id' => 'wechat_id']);
    }
}
