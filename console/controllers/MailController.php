<?php

namespace console\controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Yii;
use yii\console\Controller;
use common\components\Constant;
use common\components\SendMail;
use common\models\EmailQueue;

class MailController extends Controller
{

    public function actionSend()
    {
        $emailqueue = EmailQueue::find()->orderBy(['created_at'=>SORT_ASC])->all();
        if ($emailqueue)
        {
            foreach ($emailqueue as $value)
            {
                Yii::$app->db->createCommand()->update('email_queue', ['status' => Constant::APP_STATUS_PROCESSING], 'id = ' . $value['id'])->execute();
                if (SendMail::send($value))
                {
                    $status = Constant::APP_STATUS_SUCCESS;
                } else
                {
                    $status = Constant::APP_STATUS_ERROR;
                }
                Yii::$app->db->createCommand()
                        ->insert('email_history', [
                            'user_id'    => $value['user_id'],
                            'app_id'     => $value['app_id'],
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

}
