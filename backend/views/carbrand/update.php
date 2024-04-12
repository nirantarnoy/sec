<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CarBrand $model */

$this->title = 'แก้ไขยี่ห้อรถ: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ยี่ห้อรถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="car-brand-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
