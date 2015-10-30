<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "qr".
 *
 * @property integer $id
 * @property string $wechat_id
 * @property string $scene
 * @property integer $created_at
 * @property string $updated_at
 */
class Qr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wechat_id', 'scene', 'created_at'], 'required'],
            [['created_at'], 'integer'],
            [['updated_at'], 'safe'],
            [['wechat_id', 'scene'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wechat_id' => 'Wechat ID',
            'scene' => 'Scene',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
