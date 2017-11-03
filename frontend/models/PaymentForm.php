<?php

namespace frontend\models;

use common\models\Payment;

/**
 * Signup form
 */
class PaymentForm extends Payment {

    public $_payment;

    public function init() {
        parent::init();
        if ($this->id) {
            $this->_payment = Payment::findOne($this->id);
            $this->attributes = $this->_payment->attributes;
            
        } else {
            $this->_payment = new Payment();
            $this->auth_key = \Yii::$app->security->generateRandomString();
        }
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'api_key', 'token', 'card_number', 'card_month', 'card_year', 'card_cvc', 'description'], 'required']
        ];
    }

    public function savedata() {
        if (!$this->validate()) {
            return null;
        }
        $model = $this->_payment;
        $model->attributes = $this->attributes;
        return $model->save() ? $model : null;
    }

}
