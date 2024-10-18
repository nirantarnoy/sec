<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Quotation $model */

$this->title = 'แก้ไขใบเสนอราคา: ' . $model->quotation_no;
$this->params['breadcrumbs'][] = ['label' => 'ใบเสนอราคา', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->quotation_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="quotation-update">
    <?= $this->render('_form', [
        'model' => $model,
        'model_line'=> $model_line
    ]) ?>

</div>
