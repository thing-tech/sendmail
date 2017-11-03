<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\models\User;

class App extends ActiveRecord
{

    public static function tableName()
    {
        return 'app';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'from_name', 'from_email', 'reply_to', 'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password', 'description'], 'string'],
            [['smtp_encryption', 'allowed_attachments'], 'string'],
            ['user_id', 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'          => 'App Name',
            'smtp_host'     => 'Host',
            'smtp_port'     => 'Port',
            'smtp_username' => 'Username',
            'smtp_password' => 'Application code'
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
