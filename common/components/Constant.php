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
    const APP_STATUS_PROCESSING = 2;
    const APP_STATUS_SUCCESS = 3;
    const APP_STATUS_ERROR = 4;
    const PAYMENT_STATUS_WAITING = 1;
    const PAYMENT_STATUS_PROCESSING = 2;
    const PAYMENT_STATUS_SUCCESS = 3;
    const PAYMENT_STATUS_ERROR = 4;

    public static $app_status = [
        self::APP_STATUS_WAITING    => 'Waiting',
        self::APP_STATUS_PROCESSING => 'Processing',
        self::APP_STATUS_SUCCESS  => 'Success',
        self::APP_STATUS_ERROR    => 'Error'
    ];
    public static $payment_status = [
        self::PAYMENT_STATUS_WAITING  => 'Waiting',
        self::PAYMENT_STATUS_PROCESSING => 'Processing',
        self::PAYMENT_STATUS_SUCCESS  => 'Success',
        self::PAYMENT_STATUS_ERROR    => 'Error'
    ];

}
