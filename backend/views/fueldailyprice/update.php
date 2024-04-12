<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Fueldailyprice $model */
$date_day = date('d',strtotime($model->price_date));
$date_month = \backend\helpers\Thaimonth::getTypeById((int)(date('m',strtotime($model->price_date))));
$date_year = date('Y',strtotime($model->price_date)) + 543;

$province = \backend\models\Province::findProvinceName($model->province_id);
$name = $province.' '.$date_day.' '.$date_month.' '.$date_year;

$this->title = 'ราคาน้ำมันประจำวัน: ' . $name;
$this->params['breadcrumbs'][] = ['label' => 'ราคาน้ำมันประจำวัน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fueldailyprice-update">

    <?= $this->render('_form_new', [
        'model' => $model,
        'model_line' => $model_line,
    ]) ?>

</div>
