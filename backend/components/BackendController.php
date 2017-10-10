<?php

namespace backend\components;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class BackendController extends Controller {

    public $page;

    public function init() {
        if (\Yii::$app->request->get('page')) {
            \Yii::$app->session['page'] = \Yii::$app->request->get('page');
            $this->page = \Yii::$app->session->get('page');
        } else {
            $this->page = \Yii::$app->session->get('page');
        }
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
        ];
    }

}
