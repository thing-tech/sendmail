<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'form-setting']); ?>
            <h4>Account</h4>
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'description')->textarea() ?>
            <?= $form->field($model, 'api_key') ?>
            <?= $form->field($model, 'token') ?>
            
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'setting-button']) ?>
            </div>
        </div>
        <div class="col-lg-6">
            <h4>Card</h4>
            <?= $form->field($model, 'card_number')->textInput(['placeholder' => '4242424242424242']) ?>
            <?= $form->field($model, 'card_month')->textInput(['placeholder' => '01']) ?>
            <?= $form->field($model, 'card_year')->textInput(['placeholder' => '19']) ?> 
            <?= $form->field($model, 'card_cvc')->textInput(['placeholder' => '698']) ?> 

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
