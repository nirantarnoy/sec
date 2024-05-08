<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Bankaccount $model */

$this->title = 'แก้ไขบัญชีธนาคาร: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'บัญชีธนาคาร', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="bankaccount-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
