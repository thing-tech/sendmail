<?php

namespace backend\controllers;

use Yii;
use common\models\Location;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use backend\components\BackendController;

/**
 * LocationController implements the CRUD actions for Category model.
 */
class LocationController extends BackendController
{

    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {


        $dataProvider = new ActiveDataProvider([
            'query'      => Location::find()->orderBy('created_at DESC'),
            'pagination' => [
                'defaultPageSize' => 50
            ],
        ]);
        $model = new Location();
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {

            return $this->redirect(['index']);
        }
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model'        => $model
        ]);
    }

    public function actionCreate()
    {
        $model = new Location();
        if ($model->load(Yii::$app->request->post()) && $model->save())
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
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save())
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
        } else
        if (!empty($_POST['action']) && ($_POST['action'] == "code"))
        {
            foreach ($_POST['code'] as $k => $value)
            {
                $model = $this->findModel($k);
                $model->code = (int) $_POST['code'][$k];
                $model->save();
            }
            \Yii::$app->session->setFlash('success', \Yii::t('app', 'Code success'));
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
        return $this->redirect(['index']);
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
        if (($model = Location::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
