<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\District;

class AjaxController extends Controller
{

    public function actionDistrict()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model                       = District::find()->select('id,city_id,name')->where(['city_id' => $_POST['id']])->asArray()->all();
        return $model;
    }

}
