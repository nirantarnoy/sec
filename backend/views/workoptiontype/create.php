<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\WorkOptionType $model */

$this->title = 'สร้างหัวข้อประเภทงาน';
$this->params['breadcrumbs'][] = ['label' => 'หัวข้อประเภทงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-option-type-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_work_type_tax_info'=> null,
    ]) ?>

</div>
