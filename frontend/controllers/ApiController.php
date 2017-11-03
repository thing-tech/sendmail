<?php

namespace frontend\controllers;

use Yii;
use yii\rest\Controller;
use common\models\App;
use common\models\Payment;
use common\components\Constant;

/**
 * Default controller for the `api` module
 */
class ApiController extends Controller
{

    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors'  => [
                    // restrict access to
//                    'Origin' => ['http://compare-html.loc'],
                    'Access-Control-Request-Method'    => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    // Allow only POST and PUT methods
                    'Access-Control-Request-Headers'   => ['X-Wsse'],
                    // Allow only headers 'X-Wsse'
                    'Access-Control-Allow-Credentials' => true,
                    // Allow OPTIONS caching
                    'Access-Control-Max-Age'           => 3600,
                    // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                    'Access-Control-Expose-Headers'    => ['X-Pagination-Current-Page'],
                ],
            ],
        ];
    }

    public function init()
    {
        parent::init();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//        \Yii::$app->response->headers->add('Location', 'http://compare.loc');
    }

    public function actionSend()
    {
        $request = Yii::$app->request;
        if ($request->post('key') && $request->post('subject') && $request->post('to') && $request->post('content'))
        {
            $model = App::findOne(['auth_key' => $request->post('key')]);
            \Yii::$app->db->createCommand()
                    ->insert('email_queue', [
                        'user_id'    => $model->user_id,
                        'app_id'    => $model->id,
                        'from_name'  => $model->from_name,
                        'from_email' => $model->from_email,
                        'to'         => $request->post('to'),
                        'message'    => $request->post('content'),
                        'subject'    => $request->post('subject'),
                        'status'     => Constant::APP_STATUS_WAITING,
                        'created_at' => time(),
                        'updated_at' => time(),
                    ])
                    ->execute();
            return TRUE;
        } else
        {
            return FALSE;
        }
    }

    public function actionPayment()
    {
        $request = Yii::$app->request;
        if ($request->post('key') && $request->post('amount') && $request->post('currency') && $request->post('description') && $request->post('email') && $request->post('name'))
        {
            $model = Payment::findOne(['auth_key' => $request->post('key')]);
            \Yii::$app->db->createCommand()
                    ->insert('payment_queue', [
                        'user_id'      => $model->user_id,
                        'payment_id'   => $model->id,
                        'sender_name'  => $request->post('name'),
                        'sender_email' => $request->post('email'),
                        'amount'       => $request->post('amount'),
                        'currency'     => $request->post('currency'),
                        'description'  => $request->post('description'),
                        'status'       => Constant::PAYMENT_STATUS_WAITING,
                        'created_at'   => time(),
                        'updated_at'   => time(),
                    ])
                    ->execute();
            return TRUE;
        } else
        {
            return FALSE;
        }
    }

    public function actionSendmail()
    {
        $request = Yii::$app->request;
        if ($request->post('key') && $request->post('subject') && $request->post('to') && $request->post('content'))
        {
            $model = App::findOne(['auth_key' => $request->post('key')]);
            \Yii::$app->mailer->setTransport([
                'class'      => 'Swift_SmtpTransport',
                'host'       => $model->smtp_host,
                'username'   => $model->smtp_username,
                'password'   => $model->smtp_password,
                'port'       => $model->smtp_port,
                'encryption' => $model->smtp_encryption
            ]);
            $send = \Yii::$app->mailer->compose('send', ['data' => $request->post('content')])
                    ->setFrom([$model->from_email => $model->from_name])
                    ->setSubject($request->post('subject'))
                    ->setTo($request->post('to'))
                    ->send();
            return TRUE;
        } else
        {
            return FALSE;
        }
    }

    public function responseSuccess($data = '', $code = 200, $message = 'Success!')
    {
        $content = [
            'code'    => $code,
            'message' => $message,
            'data'    => $data,
        ];
        \Yii::$app->response->statusCode = $code;
        return $content;
    }

    public function responseError($code = 403)
    {
        \Yii::$app->response->statusCode = $code;
        $content = [
            'code'    => $code,
            'message' => \Yii::$app->response->statusText
        ];

        return $content;
    }

}
