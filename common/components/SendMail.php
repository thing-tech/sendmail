<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

use yii\base\Component;
use PHPMailer\PHPMailer\PHPMailer;

class SendMail extends Component
{

    public static function send($params)
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try
        {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $params->app->smtp_host;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $params->app->smtp_username;                 // SMTP username
            $mail->Password = $params->app->smtp_password;                           // SMTP password
            $mail->SMTPSecure = $params->app->smtp_encryption;                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = $params->app->smtp_port;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom($params->from_email, $params->from_name);
            $mail->addAddress($params->to);     // Add a recipient
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $params->subject;
            $mail->Body = $params->message;
            $mail->send();
            return TRUE;
        } catch (Exception $e)
        {
            return FALSE;
        }
    }

}
