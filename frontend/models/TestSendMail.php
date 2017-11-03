<?php

namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\App;

/**
 * Signup form
 */
class TestSendMail extends Model
{

    public $to;
    public $message;
    public $subject;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['to', 'message', 'subject'], 'required'],
        ];
    }

    public function sendEmail()
    {
        $model = App::findOne(['user_id' => \Yii::$app->user->id]);
        if (!empty($model))
        {
            \Yii::$app->mailer->setTransport([
                'class'      => 'Swift_SmtpTransport',
                'host'       => $model->smtp_host,
                'username'   => $model->smtp_username,
                'password'   => $model->smtp_password,
                'port'       => $model->smtp_port,
                'encryption' => $model->smtp_encryption
            ]);
            $send = \Yii::$app->mailer->compose('send', ['data' => $this->message])
                    ->setFrom([$model->from_email => $model->from_name])
                    ->setSubject($this->subject)
                    ->setTo($this->to)
                    ->send();
            return TRUE;
        } else
        {
            return FALSE;
        }
    }

}
