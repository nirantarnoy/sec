<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Deductitem $model */

$this->title = 'แก้ไขห้วข้อค่าใช้จ่าย: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ห้วข้อค่าใช้จ่าย', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="deductitem-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
