<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\FuelType $model */

$this->title = 'สร้างประเภทน้ำมัน';
$this->params['breadcrumbs'][] = ['label' => 'ประเภทน้ำมัน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fuel-type-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
