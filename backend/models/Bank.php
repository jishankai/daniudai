<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property string $card
 * @property string $name
 * @property integer $mobile
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
//            [['card', 'name', 'mobile', 'cid', 'created_at'], 'required'],
            [['card', 'mobile', 'created_at'], 'integer'],
            [['updated_at'], 'safe'],
            [['name', 'cid'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'card' => 'Card',
            'name' => 'Name',
            'mobile' => 'Mobile',
            'cid' => 'Cid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
