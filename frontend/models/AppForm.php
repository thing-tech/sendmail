<?php

namespace frontend\models;

use common\models\App;

/**
 * Signup form
 */
class AppForm extends App
{

    public $_app;

    public function init()
    {
        parent::init();
        if ($this->id)
        {
            $this->_app = App::findOne($this->id);
            $this->attributes = $this->_app->attributes;
        } else
        {
            $this->_app = new App();
            $this->auth_key = \Yii::$app->security->generateRandomString();
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'from_name', 'from_email', 'reply_to', 'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password', 'description'], 'required'],
            ['from_email', 'email'],
            [['smtp_encryption', 'allowed_attachments'], 'string']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function savedata()
    {
        if (!$this->validate())
        {
            return null;
        }
        $model = $this->_app;
        $model->attributes = $this->attributes;
        return $model->save() ? $model : null;
    }

}
