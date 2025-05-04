<?php

use backend\models\Advancetable;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
/** @var yii\web\View $this */
/** @var backend\models\AdvancetableSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'บันทึกรับจ่าย Cash Advance';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="advancetable-index">

    <p>
        <?= Html::a('สร้างรายการใหม่', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            [
                    'attribute' => 'trans_month',
                    'value' => function ($data) {
                        return \backend\helpers\MonthData::getTypeById($data->trans_month);
                    }
            ],
            'trans_year',
            [
                    'attribute' => 'team_id',
                    'value' => function ($data) {
                        return \backend\models\Team::findName(1);
                    }
            ],
            [
                    'attribute' => 'total_balance',
                    'value' => function ($data) {
                        return number_format($data->total_balance, 2);
                    }
            ],
            //'created_by',
            //'created_at',
            //'updated_at',
            //'updated_by',
            [

                'header' => 'ตัวเลือก',
                'headerOptions' => ['style' => 'text-align:center;', 'class' => 'activity-view-link',],
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'text-align: center'],
                'template' => '{update}{delete}',
                'buttons' => [
//                    'view' => function ($url, $data, $index) {
//                        $options = [
//                            'title' => Yii::t('yii', 'View'),
//                            'aria-label' => Yii::t('yii', 'View'),
//                            'data-pjax' => '0',
//                        ];
//                        return Html::a(
//                            '<span class="fas fa-eye btn btn-xs btn-default"></span>', $url, $options);
//                    },
                    'update' => function ($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'id' => 'modaledit',
                        ]);
                        return Html::a(
                            '<span class="fas fa-edit btn btn-xs btn-default"></span>', $url, [
                            'id' => 'activity-view-link',
                            //'data-toggle' => 'modal',
                            // 'data-target' => '#modal',
                            'data-id' => $index,
                            'data-pjax' => '0',
                            // 'style'=>['float'=>'rigth'],
                        ]);
                    },
                    'delete' => function ($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            //'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            //'data-method' => 'post',
                            //'data-pjax' => '0',
                            'data-url' => $url,
                            'data-var' => $data->id,
                            'onclick' => 'recDelete($(this));'
                        ]);
                        return Html::a('<span class="fas fa-trash-alt btn btn-xs btn-default"></span>', 'javascript:void(0)', $options);
                    }
                ]
            ],
        ],
        'pager' => ['class' => LinkPager::className()],
    ]); ?>



    <?php Pjax::end(); ?>

</div>
