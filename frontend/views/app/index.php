<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t('app', 'App');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-index">
    <div class="row">

        <div class="col-xs-12">
            <?php
            Pjax::begin([
                'id' => 'pjax_gridview_app',
            ])
            ?>
            <?php
            $form = ActiveForm::begin([
                        'id'      => 'campaignAction',
                        'action'  => ['doaction'],
                        'options' => [
                            'class' => 'form-inline'
                        ]
            ]);
            ?>
            <div class="pull-left">
                <div class="form-group" style="margin-bottom: 5px">
                    <select name="action" class="form-control">
                        <option><?= Yii::t('app', 'Builk Actions') ?></option>
                        <option value="delete"><?= Yii::t('app', 'Delete') ?></option>
                    </select>
                </div>
                <button type="submit" id="doaction" class="btn btn-default"><?= Yii::t('app', 'Apply') ?></button>
                <?= Html::a(Yii::t('app', 'Add New'), ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('app', 'Email History'), ['history'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Email Waiting'), ['waiting'], ['class' => 'btn btn-info']) ?>
            </div>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'layout'       => "{items}\n{summary}\n{pager}",
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class'         => 'yii\grid\CheckboxColumn',
                        'multiple'      => true,
                        'headerOptions' => ['width' => 10]
                    ],
                    'name',
                    'description',
                    'from_name',
                    'from_email',
                    'reply_to',
                    'auth_key',
                    [
                        'class'    => 'yii\grid\ActionColumn',
                        'template' => '{update}{delete}'
                    ],
                ],
            ]);
            ?>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end() ?> 
        </div>
    </div>
</div>
<?= $this->registerJs("
$(document).ready(function() {
    $('form#campaignAction button[type=submit]').click(function() {
        return confirm('Rollback deletion of candidate table?');
    });
});
") ?>