<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Workorder $model */

$this->title = 'แก้ไขใบแจ้งซ่อม: ' . $model->workorder_no;
$this->params['breadcrumbs'][] = ['label' => 'ใบแจ้งซ่อม', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->workorder_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="workorder-update">
    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => $model_line,
    ]) ?>

</div>
