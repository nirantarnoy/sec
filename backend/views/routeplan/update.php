<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Routeplan $model */

$this->title = 'แก้ไขจัดการปลายทาง: ' . $model->des_name;
$this->params['breadcrumbs'][] = ['label' => 'จัดการปลายทาง', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->des_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="routeplan-update">


    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => $model_line,
        'model_line2' => $model_line2,
    ]) ?>

</div>
