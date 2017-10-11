
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>
                    <?= $form->field($model, 'password_new')->passwordInput() ?>
                    <?= $form->field($model, 'password_repeat')->passwordInput() ?>
                    

                <div class="form-group">
                    <?= Html::submitButton('Change Password', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
