<?php

use backend\models\Stocksum;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\StocksumSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'สินค้า/อะไหล่คงเหลือ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stocksum-index">

    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'company_id',
            [
                'attribute' => 'warehouse_id',
                'value' => function ($data) {
                    return \backend\models\Warehouse::findName($data->warehouse_id);
                }
            ],
            [
                'attribute' => 'item_id',
                'value' => function ($data) {
                    return \backend\models\Product::findName($data->item_id);
                }
            ],
            'qty',
            //'last_update',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
