<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Journalissue $model */

$this->title = 'แก้ไขรายการเบิกสินค้า/อะไหล่: ' . $model->journal_no;
$this->params['breadcrumbs'][] = ['label' => 'เบิกสินค้า/อะไหล่', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->journal_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="journalissue-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => $model_line,
    ]) ?>

</div>
