<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Purchorder $model */

$this->title = 'แก้ไขคำสั่งซื้อ: ' . $model->purch_no;
$this->params['breadcrumbs'][] = ['label' => 'คำสั่งซื้อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->purch_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="purchorder-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_line'=>$model_line,
    ]) ?>

</div>
