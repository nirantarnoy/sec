<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Worktype $model */

$this->title = 'แก้ไขประเภทงาน: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="worktype-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
