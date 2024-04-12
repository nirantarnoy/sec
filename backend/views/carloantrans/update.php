<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Carloantrans $model */

$this->title = 'แก้ไขบันทึกชำระค่างวด: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'บันทึกชำระค่างวด', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="carloantrans-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
