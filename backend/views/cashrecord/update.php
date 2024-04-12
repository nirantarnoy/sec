<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Cashrecord $model */

$this->title = 'แก้ไขบันทึกเงินสด: ' . $model->journal_no;
$this->params['breadcrumbs'][] = ['label' => 'บันทึกเงินสด', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->journal_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="cashrecord-update">


    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => $model_line,
    ]) ?>

</div>
