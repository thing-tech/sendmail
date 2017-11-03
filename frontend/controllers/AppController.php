<?php

namespace frontend\controllers;

use Yii;
use common\models\App;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use frontend\models\AppForm;
use common\models\Subscriber;
use common\models\EmailQueue;
use common\models\Customer;
use frontend\controllers\FrontendController;

/**
 * App controller
 */
class AppController extends FrontendController
{

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query'      => App::find()->orderBy('created_at DESC'),
            'pagination' => [
                'defaultPageSize' => 20
            ],
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new AppForm();
        if ($model->load(Yii::$app->request->post()) && $model->savedata())
        {
            \Yii::$app->session->setFlash('success', \Yii::t('app', 'Add new success'));
            return $this->redirect(['index']);
        } else
        {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = new AppForm(['id' => $id]);
        if ($model->load(Yii::$app->request->post()) && $model->savedata())
        {
            return $this->redirect(['index']);
        } else
        {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionDoaction()
    {
        if (!empty($_POST['selection']) && ($_POST['action'] == "delete"))
        {
            foreach ($_POST['selection'] as $value)
            {
                $this->findModel($value)->delete();
            }
            \Yii::$app->session->setFlash('success', \Yii::t('app', 'Delete success'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id)->delete();
        \Yii::$app->session->setFlash('success', \Yii::t('app', 'Delete success'));
        return $this->redirect(['index']);
    }

    public function actionSend($id)
    {
        $model = $this->findModel($id);
        $send = new SendForm();
        $send->attributes = $model->attributes;
        if ($send->load(Yii::$app->request->post()))
        {
            $setting = Setting::findOne(['user_id' => \Yii::$app->user->id]);
            \Yii::$app->mailer->setTransport([
                'class'      => 'Swift_SmtpTransport',
                'host'       => $setting->smtp_host,
                'username'   => $setting->smtp_username,
                'password'   => $setting->smtp_password,
                'port'       => $setting->smtp_port,
                'encryption' => $setting->smtp_encryption
            ]);

            $mails = Subscriber::find()->where(['list_id' => $send->list])->all();
            if ($mails)
            {
                foreach ($mails as $key => $value)
                {
                    $template = $send->template;
                    $template = str_replace("[name]", $value->name, $template);
                    $template = str_replace("[email]", $value->email, $template);
                    \Yii::$app->mailer->compose('send', ['data' => $template])
                            ->setFrom([$send->from_email => $send->from_name])
                            ->setSubject($model->subject)
                            ->setTo($value->email)
                            ->send();
                }

                \Yii::$app->session->setFlash('success', \Yii::t('app', 'Send mail success'));
            }
            return $this->redirect(['send', 'id' => $id]);
        } else
        {
            return $this->render('send', [
                        'model' => $model,
                        'send'  => $send
            ]);
        }
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = App::findOne(['id' => $id, 'user_id' => \Yii::$app->user->id])) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
