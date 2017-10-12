<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Template;

class AjaxController extends Controller
{

    public function init()
    {
        parent::init();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public function actionTemplate()
    {
        $data = Template::find()
                ->select(['name', 'html'])
                ->where(['id' => $_POST['id']])
                ->one();
        return $this->responseSuccess($data);
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
