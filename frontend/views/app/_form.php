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
            <?= $form->field($model, 'from_name') ?>
            <?= $form->field($model, 'from_email') ?>
            <?= $form->field($model, 'reply_to') ?>
            <?= $form->field($model, 'allowed_attachments')->textInput(['value' => 'jpeg,jpg,gif,png,pdf,zip']) ?>
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'setting-button']) ?>
            </div>
        </div>
        <div class="col-lg-6">
            <h4>Config Mail</h4>
            <?= $form->field($model, 'smtp_host')->textInput(['value' => 'smtp.gmail.com']) ?>
            <?= $form->field($model, 'smtp_port')->textInput(['value' => '587']) ?>
            <?= $form->field($model, 'smtp_encryption')->dropDownList(['SSL' => 'SSL', 'TLS' => 'TLS']) ?> 
            <?= $form->field($model, 'smtp_username') ?> 
            <?=
            $form->field($model, 'smtp_password', [
                'options'  => ['class' => 'form-group '],
                "template" => "<label class=\"control-label\">" . $model->getAttributeLabel('smtp_password') . "</label><p><a href='https://support.google.com/accounts/answer/185833?hl=en'>How to generate application code</a></p>{input}\n{hint}\n{error}"
            ])
            ?>


            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
