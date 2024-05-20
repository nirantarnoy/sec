<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Company $model */

$this->title = 'แก้ไขบริษัท: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'บริษัท', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="company-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
