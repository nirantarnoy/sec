<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Preinvoice $model */

$this->title = 'แก้ไขใบรวมบิล: ' . $model->journal_no;
$this->params['breadcrumbs'][] = ['label' => 'รวมบิล', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->journal_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="preinvoice-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => $model_line,
    ]) ?>

</div>
