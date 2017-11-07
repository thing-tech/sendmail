<?php

namespace frontend\controllers;

use frontend\models\TestSendMail;

class CronController extends \yii\web\Controller
{

    public function actionSendmail()
    {
        TestSendMail::send();
    }

}
