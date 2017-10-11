<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\Setting;

class FrontendController extends Controller
{

    public function init()
    {
        parent::init();
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    protected function sendemail($template, $data, $role = NULL)
    {

        if (!empty($role))
        {
            \Yii::$app->mailer->setTransport([
                'class'      => 'Swift_SmtpTransport',
                'host'       => 'smtp.gmail.com',
                'username'   => 'minaworksvn@gmail.com',
                'password'   => 'minaworksvn17',
                'port'       => '587',
                'encryption' => 'tls'
            ]);
        } else
        {
            $model = Setting::findOne(['user_id' => \Yii::$app->user->id]);
            \Yii::$app->mailer->setTransport([
                'class'      => 'Swift_SmtpTransport',
                'host'       => $model->smtp_host,
                'username'   => $model->smtp_username,
                'password'   => $model->smtp_password,
                'port'       => $model->smtp_port,
                'encryption' => $model->smtp_encryption
            ]);
        }
        $send = \Yii::$app->mailer->compose($template, ['data' => $data['user']])
                ->setFrom(['minaworksvn@gmail.com' => 'Vinh Huynh'])
                ->setSubject($data['subject'])
                ->setTo($data['to'])
                ->send();
        return $send;
    }

}
