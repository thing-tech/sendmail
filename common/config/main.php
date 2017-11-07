<?php

//
date_default_timezone_set('Asia/Ho_Chi_Minh');
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache'  => [
            'class' => 'yii\caching\FileCache',
        ],
        'mail' => [
            'class'            => 'zyx\phpmailer\Mailer',
            'viewPath'         => '@common/mail',
            'useFileTransport' => FALSE,
        ],
        'redis'  => [
            'class'    => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port'     => 6379,
            'database' => 10,
        ],
    ],
];
