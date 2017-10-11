<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>


<?php
$form = ActiveForm::begin();
?>  
<div class="row">
    <div class="col-lg-4">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'from_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'from_email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'reply_to')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-8">
        <?= $form->field($model, 'template_id')->dropDownList($model->templates)->label(FALSE) ?>
        <?= $form->field($model, 'template')->textarea(['rows' => 6]) ?>
    </div>
</div>



<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>