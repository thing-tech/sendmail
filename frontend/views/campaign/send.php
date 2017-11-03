<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Campaign'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-create">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php
            $form = ActiveForm::begin();
            ?>  
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($send, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($send, 'subject')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($send, 'from_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($send, 'from_email')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($send, 'reply_to')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($send, 'list')->dropDownList($send->lists())->label() ?>
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>

                </div>
                <div class="col-lg-8">

                    <div class="form-group field-campaign-template">
                        <label class="control-label" for="campaign-template">Template</label>
                        <textarea id="campaign-template" class="tinymce" name="SendForm[template]"><?= $send->template ?></textarea>
                        <p class="help-block help-block-error"></p>
                    </div> 
                    <div class="row">
                        <div class="col-lg-12">
                            <p>
                                Bạn có thể sử dụng các tag sau đây trong tiêu đề, văn bản thuần túy hay mã HTML và chúng sẽ tự động được định dạng khi chiến dịch được gửi đi. Với tag webversion và unsubscribe, bạn có thể style với inline CSS.
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <h3>Tag thiết yếu (HTML)</h3>
                            <p>Các tag sau có thể sử dụng cả với trình soạn thảo HTML hay văn bản thuần túy</p>
                            <p>
                                <strong>Liên kết Webversion : </strong>
                                <code>[webversion]</code>
                            </p>
                            <p>
                                <strong>Liên kết hủy đăng ký: </strong>
                                <code>[unsubscribe]</code>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <h3>Tag cá nhân hóa</h3>
                            <p>Các tag sau có thể sử dụng cả với trình soạn thảo HTML hay văn bản thuần túy</p>
                            <p>
                                <strong>Name:</strong>
                                <code>[name]</code>
                            </p>
                            <p>
                                <strong>Email</strong>
                                <code>[email]</code>
                            </p>
                            <p>
                                <strong>Định dạng ngày 2 số: </strong>
                                <code>[currentdaynumber]</code>
                            </p>
                            <p>
                                <strong>Định dạng tháng 2 số: </strong>
                                <code>[currentmonthnumber]</code>
                            </p>
                            <p>
                                <strong>Định dạng tháng đầy đủ: </strong>
                                <code>[currentmonth]</code>
                            </p>
                            <p>
                                <strong>Định dạng năm 4 số</strong>
                                <code>[currentyear]</code>
                            </p>
                        </div>
                    </div>
                </div>
            </div>



            <?php ActiveForm::end(); ?>
        </div>


    </div>
</div>