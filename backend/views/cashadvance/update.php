<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Cashadvance $model */

$this->title = 'บันทึกรับจ่าย: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cash Advances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cashadvance-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
