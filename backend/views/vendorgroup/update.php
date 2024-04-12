<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Vendorgroup $model */

$this->title = 'แก้ไขกลุ่มผู้ขาย: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'กลุ่มผู้ขาย', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="vendorgroup-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
