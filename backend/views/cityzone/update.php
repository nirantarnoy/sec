<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Cityzone $model */

$this->title = 'แก้ไขโซนพื้นที่: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'โซนพื้นที่', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="cityzone-update">

    <?= $this->render('_form', [
        'model' => $model,
        'zone_line_data'=> $zone_line_data,
        'zone_line_district_data'=>$zone_line_district_data,
    ]) ?>

</div>
