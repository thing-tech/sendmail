<?php

use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use common\components\Constant;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t('app', 'Email History');
$this->params['breadcrumbs'][] = ['label' => \Yii::t('app', 'App'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-index">
    <div class="row">

        <div class="col-xs-12">
            <?php
            Pjax::begin([
                'id' => 'pjax_gridview_email',
            ])
            ?>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'layout'       => "{items}\n{summary}\n{pager}",
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'to',
                    'subject',
                    [
                        'attribute' => 'status',
                        'format'    => 'raw',
                        'value'     => function($data)
                        {
                            return Constant::$app_status[$data->status];
                        },
                    ],
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
            <?php Pjax::end() ?> 
        </div>
    </div>
</div>
