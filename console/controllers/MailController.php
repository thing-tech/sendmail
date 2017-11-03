<?php

namespace console\controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Yii;
use yii\console\Controller;
use common\models\App;

class MailController extends Controller
{

    public function actionSend()
    {
        $emailqueue = Yii::$app->db->createCommand('SELECT * FROM email_history')->queryAll();
        foreach ($emailqueue as $value)
        {
            Yii::$app->db->createCommand()->update('email_queue', ['status' => 'Processing'], 'id = ' . $value['id'])->execute();
            $model = App::findOne($value['user_id']);
            \Yii::$app->mailer->setTransport([
                'class'      => 'Swift_SmtpTransport',
                'host'       => $model->smtp_host,
                'username'   => $model->smtp_username,
                'password'   => $model->smtp_password,
                'port'       => $model->smtp_port,
                'encryption' => $model->smtp_encryption
            ]);
            $send = \Yii::$app->mailer->compose('send', ['data' => $value['message']])
                    ->setFrom([$value['from_email'] => $value['from_name']])
                    ->setSubject($value['subject'])
                    ->setTo($value['to'])
                    ->send();
            if ($send)
            {
                $status = 'Success';
            } else
            {
                $status = 'Error';
            }
            Yii::$app->db->createCommand()
                    ->insert('email_history', [
                        'user_id'    => $value['user_id'],
                        'to'         => $value['to'],
                        'status'     => $status,
                        'created_at' => time(),
                        'updated_at' => time(),
                    ])
                    ->execute();
            Yii::$app->db->createCommand()->delete('email_queue', 'id = ' . $value['id'])->execute();
        }
    }

}
