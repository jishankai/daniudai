<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property string $wechat_id
 * @property string $stu_id
 * @property integer $school_id
 * @property string $dorm
 * @property integer $grade
 * @property integer $created_at
 * @property string $updated_at
 *
 * @property School $school
 * @property User $wechat
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['wechat_id', 'school_id', 'dorm', 'grade', 'created_at'], 'required'],
            [['school_id', 'grade', 'created_at'], 'integer'],
            [['updated_at'], 'safe'],
            [['wechat_id', 'dorm'], 'string', 'max' => 45],
            [['stu_id'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wechat_id' => 'Wechat ID',
            'stu_id' => 'Stu ID',
            'school_id' => 'School ID',
            'dorm' => 'Dorm',
            'grade' => 'Grade',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(School::className(), ['school_id' => 'school_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWechat()
    {
        return $this->hasOne(User::className(), ['wechat_id' => 'wechat_id']);
    }
}
