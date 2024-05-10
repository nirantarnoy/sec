<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Deliveryorder $model */

$this->title = 'แก้ไขใบส่งของ: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ใบส่งของ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="deliveryorder-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => $model_line,
    ]) ?>

</div>
