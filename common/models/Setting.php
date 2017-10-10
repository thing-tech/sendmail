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
            return [
            [['user_id','name', 'from_name', 'from_email', 'reply_to', 'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password'], 'string'],
            [['smtp_ssl', 'allowed_attachments'], 'string']
        ];
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

}
