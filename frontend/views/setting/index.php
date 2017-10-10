<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Setting';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'form-setting']); ?>
            <h4>Account</h4>
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'from_name') ?>
            <?= $form->field($model, 'from_email') ?>
            <?= $form->field($model, 'reply_to') ?>
            <?= $form->field($model, 'allowed_attachments')->textInput(['value' => 'jpeg,jpg,gif,png,pdf,zip']) ?>
        </div>
        <div class="col-lg-6">
            <h4>Thiết lập SMTP (chỉ áp dụng nếu bạn không sử dụng Amazon SES)</h4>
            <p>Nếu bạn muốn sử dụng nhà cung cấp dịch vụ email khác thay vì sử dụng Amazon SES để gửi email, 
                bạn có thể thiết lập SMTP tại đây. Bạn phải xóa bỏ thiết lập 'Amazon Web Services Credentials' để gửi email bằng SMTP này. 
                Lưu ý rằng, chế độ đa luồng không được hỗ trợ, quy trình xử lý email bị trả lại, 
                email bị phàn này cũng sẽ không thể sử dụng nếu bạn sử dụng nhà cung cấp dịch vụ email khác để gửi mail.
            </p>
            <?= $form->field($model, 'smtp_host')->textInput(['value' => 'smtp.gmail.com']) ?>
            <?= $form->field($model, 'smtp_port')->textInput(['value' => '587']) ?>
            <?= $form->field($model, 'smtp_ssl')->dropDownList(['SSL' => 'SSL', 'TLS' => 'TLS']) ?> 
            <?= $form->field($model, 'smtp_username') ?> 
            <?= $form->field($model, 'smtp_password') ?>
            <div class="form-group">
                <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'setting-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
