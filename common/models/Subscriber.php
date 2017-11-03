<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\models\User;

/**
 * Location model
 *
 * @property string $name
 * @property string $sectors
 */
class Subscriber extends ActiveRecord
{

    public static function tableName()
    {
        return 'subscriber';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['email'], 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ]);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            $this->user_id = \Yii::$app->user->id;
            return true;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
