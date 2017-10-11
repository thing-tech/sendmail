<?php

namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class ProfileForm extends Model {

    public $username;
    public $fullname;
    public $email;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'fullname'], 'required'],
            ['username', 'trim'],
            [['username', 'fullname'], 'required'],
            ['username', 'validateUsername'],
            ['username', 'string', 'min' => 5, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'validateEmail'],
        ];
    }

    public function validateUsername($attribute, $params) {
        if (!$this->hasErrors()) {
            $model = User::find()->where(['username' => $this->username])->one();
            if (!empty($model)) {
                if ($model->id != \Yii::$app->user->id)
                    $this->addError($attribute, $this->username . \Yii::t('app', 'already exists'));
            }
        }
    }

    public function validateEmail($attribute, $params) {
        if (!$this->hasErrors()) {
            $model = User::find()->where(['email' => $this->email])->one();
            if (!empty($model)) {
                if ($model->id != \Yii::$app->user->id)
                    $this->addError($attribute, $this->email . \Yii::t('app', 'already exists'));
            }
        }
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save() {

        if (!$this->validate()) {
            return null;
        }
        $user = User::findOne(\Yii::$app->user->id);
        $user->username = $this->username;
        $user->fullname = $this->fullname;
        $user->email = $this->email;
        return $user->save() ? $user : NULL;
    }

}
