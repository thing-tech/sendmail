<?php

namespace common\models;

use yii\db\ActiveRecord;

class Setting extends ActiveRecord
{

    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            [['name', 'form_name', 'form_email', 'reply_to', 'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password'], 'required'],
            ['smtp_ssl', 'string']
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(
                parent::attributeLabels(), [
                ]
        );
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

}