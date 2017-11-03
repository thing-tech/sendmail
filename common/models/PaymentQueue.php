<?php

namespace common\models;

/**
 * This is the model class for table "{{payment_queue}}".
 *
 * The followings are the available columns in table '{{payment_queue}}':
 * @property integer $id
 * @property string $sender_name
 * @property string $sender_email
 * @property string $currency
 * @property string $amount
 * @property string $description
 */
class PaymentQueue extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'payment_queue';
    }

    public function rules()
    {
        return [
            [['sender_name', 'sender_email', 'description', 'currency'], 'string'],
            [['amount', 'status'], 'integer']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Payment::className(), ['id' => 'payment_id']);
    }

}
