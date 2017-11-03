<?php

/**
 * Created by PhpStorm.
 * User: huynhtuvinh87
 * Date: 5/24/17
 * Time: 17:08
 */

namespace common\components;

class Constant
{

    const APP_STATUS_WAITING = 1;
    const APP_STATUS_PENDDING = 2;
    const APP_STATUS_SUCCESS = 3;
    const PAYMENT_STATUS_WAITING = 1;
    const PAYMENT_STATUS_PENDING = 2;
    const PAYMENT_STATUS_SUCCESS = 3;
    const APP_STATUS = [
        1 => 'Waiting',
        2 => 'Pending',
        3 => 'Success'
    ];
    const PAYMENT_STATUS = [
        1 => 'Waiting',
        2 => 'Pending',
        3 => 'Success'
    ];

}
