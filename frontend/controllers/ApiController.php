<?php

namespace frontend\controllers;

use Yii;
use yii\rest\Controller;

/**
 * Default controller for the `api` module
 */
class ApiController extends Controller {

    public function behaviors() {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    // restrict access to
                    'Origin' => ['http://compare-html.loc'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    // Allow only POST and PUT methods
                    'Access-Control-Request-Headers' => ['X-Wsse'],
                    // Allow only headers 'X-Wsse'
                    'Access-Control-Allow-Credentials' => true,
                    // Allow OPTIONS caching
                    'Access-Control-Max-Age' => 3600,
                    // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                    'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
                ],
            ],
        ];
    }

    public function init() {
        parent::init();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        \Yii::$app->response->headers->add('Location', 'http://compare.loc');
    }

    public function responseSuccess($data = '', $code = 200, $message = 'Success!') {
        $content = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];
        \Yii::$app->response->statusCode = $code;
        return $content;
    }

    public function responseError($code = 403) {
        \Yii::$app->response->statusCode = $code;
        $content = [
            'code' => $code,
            'message' => \Yii::$app->response->statusText
        ];

        return $content;
    }

}
