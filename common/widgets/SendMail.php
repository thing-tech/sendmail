<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\widgets;

use yii\base\Widget;
use common\models\App;
use PHPMailer;

class SendMail extends Widget
{

    public function run()
    {
        $model = App::findOne(1);
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try
        {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $model->smtp_host;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $model->smtp_username;                 // SMTP username
            $mail->Password = $model->smtp_password;                           // SMTP password
            $mail->SMTPSecure = $model->smtp_encryption;                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = $model->smtp_port;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom('huynhtuvinh87@gmail.com', 'Mailer');
            $mail->addAddress('giicmsvn@gmail.com', 'Joe User');     // Add a recipient
//            $mail->addAddress('gii@gmail.com');               // Name is optional
//            $mail->addReplyTo('info@example.com', 'Information');
//            $mail->addCC('cc@example.com');
//            $mail->addBCC('bcc@example.com');

            //Attachments
//            $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Test thử mail';
            $mail->Body = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e)
        {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

//        $model = App::findOne(1);
//        if (!empty($model))
//        {
//            $config = \Yii::$app->mailer->setTransport([
//                'class'      => 'Swift_SmtpTransport',
//                'host'       => $model->smtp_host,
//                'username'   => $model->smtp_username,
//                'password'   => $model->smtp_password,
//                'port'       => $model->smtp_port,
//                'encryption' => $model->smtp_encryption
//            ]);
//            var_dump($config);
//            exit;
//            $send = \Yii::$app->mailer->compose('send', ['data' => 'saaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'])
//                    ->setFrom([$model->from_email => $model->from_name])
//                    ->setSubject('sssssssssssssssss')
//                    ->setTo('huynhtuvinh87@gmail.com')
//                    ->send();
//            var_dump($send);
//            exit;
//            return $send;
//        } else
//        {
//            return FALSE;
//        }
    }

}
