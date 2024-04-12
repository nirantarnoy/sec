<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Fuel $model */

$this->title = 'สร้างน้ำมัน';
$this->params['breadcrumbs'][] = ['label' => 'น้ำมัน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fuel-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
