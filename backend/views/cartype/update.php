<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CarType $model */

$this->title = 'แก้ไขประเภทรถ: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทรถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="car-type-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
