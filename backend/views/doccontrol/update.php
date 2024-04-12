<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Doccontrol $model */

$this->title = 'อัพเดทเอกสาร: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'เอกสาร', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="doccontrol-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
