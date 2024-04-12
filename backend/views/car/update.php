<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Car $model */

$this->title = 'แก้ไขรถ: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'รถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="car-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
        'model_doc'=> $model_doc,
        'model_car_loan'=>$model_car_loan,
    ]) ?>

</div>
