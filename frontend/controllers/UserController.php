<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ProfileForm;
use frontend\models\PasswordForm;
use common\models\User;
use frontend\controllers\FrontendController;

/**
 * User controller
 */
class UserController extends FrontendController {

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionChangeprofile() {
        $model = new ProfileForm();
        $model->attributes = User::findOne(\Yii::$app->user->id)->attributes;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            return $this->redirect(['changeprofile']);
        }
        return $this->render('changeprofile', [
                    'model' => $model,
        ]);
    }

    public function actionChangepassword() {
        $model = new PasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            return $this->redirect(['changeprofile']);
        }
        return $this->render('changepassword', [
                    'model' => $model,
        ]);
    }

}
