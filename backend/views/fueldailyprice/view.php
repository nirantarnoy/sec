<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Fueldailyprice $model */

$date_day = date('d',strtotime($model->price_date));
$date_month = \backend\helpers\Thaimonth::getTypeById((int)(date('m',strtotime($model->price_date))));
$date_year = date('Y',strtotime($model->price_date)) + 543;

$province = \backend\models\Province::findProvinceName($model->province_id);
$name = $province.' '.$date_day.' '.$date_month.' '.$date_year;

$this->title = $name;
$this->params['breadcrumbs'][] = ['label' => 'ราคาน้ำมันประจำวัน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fueldailyprice-view">

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'fuel_id',
            [
                'attribute' => 'fuel_id',
                'value' => function ($data) {
                    return \backend\models\Fuel::findName($data->fuel_id);
                }
            ],
//            'province_id',
            [
                'attribute' => 'province_id',
                'value' => function ($data) {
                    return \backend\models\Province::findProvinceName($data->province_id);
                }
            ],
//            'city_id',
//            [
//                'attribute' => 'city_id',
//                'value' => function ($data) {
//                    return \backend\models\Amphur::findAmphurName($data->city_id);
//                }
//            ],
            [
                'attribute' => 'cityzone_id',
                'value' => function ($data) {
                    return \backend\models\Cityzone::findName($data->cityzone_id);
                }
            ],
            'price_date',
            'price',
//            'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->status == 1) {
                        return '<div class="badge badge-success" >ใช้งาน</div>';
                    } else {
                        return '<div class="badge badge-secondary" >ไม่ใช้งาน</div>';
                    }
                }
            ],
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
