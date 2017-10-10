<?php

namespace common\models;

use yii\base\Model;

/**
 * Login form
 */
class Forgot extends Model {

    public $email;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['email'], 'required'],
                [['email'], 'email'],
                ['email', 'validateEmail'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateEmail($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = User::find()->where(['email' => $this->email])->one();
            if (empty($user)) {
                $this->addError($attribute, 'This email does not exist.');
            }
        }
    }

}
