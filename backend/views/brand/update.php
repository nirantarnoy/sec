<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Brand $model */

$this->title = 'แก้ไขยี่ห้อสินค้า: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ยี่ห้อสินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="brand-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
