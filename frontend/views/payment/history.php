<?php

use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use common\components\Constant;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t('app', 'Payment History');
$this->params['breadcrumbs'][] = ['label' => \Yii::t('app', 'Payment'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-index">
    <div class="row">

        <div class="col-xs-12">
            <?php
            Pjax::begin([
                'id' => 'pjax_gridview_payment',
            ])
            ?>
            <?php
            $form = ActiveForm::begin([
                        'id'      => 'paymentAction',
                        'action'  => ['doaction'],
                        'options' => [
                            'class' => 'form-inline'
                        ]
            ]);
            ?>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'layout'       => "{items}\n{summary}\n{pager}",
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'sender_name',
                    'sender_email',
                    'amount',
                    'currency',
                    [
                        'attribute' => 'status',
                        'format'    => 'raw',
                        'value'     => function($data)
                        {
                            return Constant::$payment_status[$data->status];
                        },
                    ],
                    'description',
                    [
                        'attribute' => 'created_at',
                        'format'    => 'raw',
                        'value'     => function($data)
                        {
                            return date('d/m/Y', $data->created_at);
                        },
                    ],
                ],
            ]);
            ?>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end() ?> 
        </div>
    </div>
</div>
