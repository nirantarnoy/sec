<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Distributor $model */

$this->title = 'แก้ไขบริษัทผู้นำเข้า: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'บริษัทผู้นำเข้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="distributor-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
