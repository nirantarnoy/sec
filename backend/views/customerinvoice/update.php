<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Customerinvoice $model */

$this->title = 'แก้ไขใบวางบิล: ' . $model->invoice_no;
$this->params['breadcrumbs'][] = ['label' => 'วางบิล', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->invoice_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="customerinvoice-update">
    <?= $this->render('_form', [
        'model' => $model,
        'modelline'=> $modelline,
    ]) ?>

</div>
