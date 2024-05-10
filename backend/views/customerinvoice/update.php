<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Customerinvoice $model */

$this->title = 'แก้ไขใบกำกับภาษี: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ใบกำกับภาษี', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="customerinvoice-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => $model_line,
    ]) ?>

</div>
