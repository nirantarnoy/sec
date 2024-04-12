<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\FixcostTitle $model */

$this->title = 'แก้ไขรายการค่าใช้จ่าย: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'รายการค่าใช้จ่าย', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="fixcost-title-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
