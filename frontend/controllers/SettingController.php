<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use frontend\models\SettingForm;

/**
 * Site controller
 */
class SettingController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new SettingForm();
        $model->user_id = \Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->edit())
        {
            Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            return $this->redirect(['index']);
        }
        return $this->render('index', [
                    'model' => $model,
        ]);
    }

}
