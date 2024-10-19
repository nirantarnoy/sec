<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Purch */

$this->title = 'แก้ไขใบสั่งซื้อ: ' . $model->purch_no;
$this->params['breadcrumbs'][] = ['label' => 'ใบสั่งซื้อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->purch_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="purch-update">
    <?= $this->render('_form', [
        'model' => $model,
        'model_line'=> $model_line
    ]) ?>

</div>
