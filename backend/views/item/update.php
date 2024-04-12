<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Item $model */

$this->title = 'แก้ไขของนำกลับ: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ของนำกลับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="item-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
