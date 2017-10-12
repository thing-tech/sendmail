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

        <div class="form-group field-campaign-template">
            <label class="control-label" for="campaign-template">Template</label>
            <?= $form->field($model, 'template_id')->dropDownList($model->templates)->label(FALSE) ?>
            <textarea id="campaign-template" class="tinymce" name="Campaign[template]"><?= $model->template ?></textarea>
            <p class="help-block help-block-error"></p>
        </div> 
    </div>
</div>



<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

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