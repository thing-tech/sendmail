<?php

namespace common\models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Customer extends \yii\redis\ActiveRecord
{

    public $oldPrimaryKey = 'name';
    /**
     * @return array the list of attributes for this record
     */
    public function attributes()
    {
        return ['id', 'customer', 'name', 'address', 'registration_date'];
    }
   public function rules()
    {
        return [
            [['customer', 'name', 'address'], 'string'],
//            [['date_published', 'date_sent', 'success', 'attempts', 'max_attempts'], 'integer']
        ];
    }
    /**
     * @return ActiveQuery defines a relation to the Order record (can be in other database, e.g. elasticsearch or sql)
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id']);
    }

    /**
     * Defines a scope that modifies the `$query` to return only active(status = 1) customers
     */
    public static function active($query)
    {
        $query->andWhere(['status' => 1]);
    }

}
