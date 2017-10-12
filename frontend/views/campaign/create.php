<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = Yii::t('app', 'Add New');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Campaign'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-create">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?= $this->render('_form', ['model' => $model]) ?>
        </div>


    </div>
</div>