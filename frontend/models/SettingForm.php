<?php

namespace frontend\models;

use common\models\Setting;

/**
 * Signup form
 */
class SettingForm extends Setting
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'from_name', 'from_email', 'reply_to', 'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password'], 'required'],
            [['smtp_smtp_encryption', 'allowed_attachments'], 'string']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function edit()
    {
        if (!$this->validate())
        {
            return null;
        }

        $model = Setting::findOne(['user_id' => \Yii::$app->user->id]);
        $model->attributes = $this->attributes;
        return $model->save() ? $model : null;
    }

}
