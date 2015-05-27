<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "school".
 *
 * @property integer $school_id
 * @property string $name
 * @property string $depart
 * @property string $major
 * @property integer $degree
 * @property integer $created_at
 * @property string $updated_at
 *
 * @property Student[] $students
 */
class School extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['school_id', 'name', 'depart', 'major', 'degree', 'created_at'], 'required'],
            [['school_id', 'degree', 'created_at'], 'integer'],
            [['updated_at'], 'safe'],
            [['name', 'depart', 'major'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'school_id' => 'School ID',
            'name' => 'Name',
            'depart' => 'Depart',
            'major' => 'Major',
            'degree' => 'Degree',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['school_id' => 'school_id']);
    }
}
