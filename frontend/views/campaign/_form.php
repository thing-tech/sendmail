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
        <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'from_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'from_email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'reply_to')->textInput(['maxlength' => true]) ?>

        <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'submit', 'value' => 'save']) ?>
        <?= Html::submitButton('Save and Send', ['class' => 'btn btn-suucess', 'name' => 'submit', 'value' => 'save_send']) ?>
    </div>
    <div class="col-lg-8">

        <div class="form-group field-campaign-template">
            <label class="control-label" for="campaign-template">Template</label>
            <?= $form->field($model, 'template_id')->dropDownList($model->templates)->label(FALSE) ?>
            <textarea id="campaign-template" class="tinymce" name="Campaign[template]"><?= $model->template ?></textarea>
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
<?= $this->registerJs('
    $("#campaign-template_id").on("change",function(){  
         $.ajax({
            url:"' . Yii::$app->urlManager->createUrl(["ajax/template"]) . '",
            type:"POST",            
            data:"id="+$("#campaign-template_id option:selected").val(),
            dataType:"json",
            success:function(data){    
                $("#campaign-template").html(data.data.html);
                tinymce.activeEditor.dom.remove(tinymce.activeEditor.dom.select("p"));
                tinymce.activeEditor.insertContent(data.data.html);
            }
        });
    });
')
?>