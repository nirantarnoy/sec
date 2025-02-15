<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Paymentstatus $model */

$this->title = 'แก้ไขสถานะชำระเงิน: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'สถานะชำระเงิน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="paymentstatus-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
