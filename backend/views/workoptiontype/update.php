<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\WorkOptionType $model */

$this->title = 'แก้ไขหัวข้อประเภทงาน: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'หัวข้อประเภทงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="work-option-type-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_work_type_tax_info'=>$model_work_type_tax_info,
    ]) ?>

</div>
