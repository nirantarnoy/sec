<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Team $model */

$this->title = 'แก้ไขทีม: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ทีม', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="team-update">
    <?= $this->render('_form', [
        'model' => $model,
        'model_line'=> $model_line,
    ]) ?>

</div>
