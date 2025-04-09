<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Advancetable $model */

$this->title = 'แก้ไขรายการ Cash Advance: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cash Advance', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="advancetable-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => $model_line
    ]) ?>

</div>
