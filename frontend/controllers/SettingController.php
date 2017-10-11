<?php

namespace frontend\controllers;

use Yii;
use frontend\models\SettingForm;
use common\models\Setting;
use frontend\controllers\FrontendController;

/**
 * Site controller
 */
class SettingController extends FrontendController
{

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new SettingForm();
        $model->attributes = Setting::findOne(['user_id' => \Yii::$app->user->id])->attributes;
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
