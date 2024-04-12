<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Workorder $model */

$this->title = 'สร้างใบแจ้งซ่อม';
$this->params['breadcrumbs'][] = ['label' => 'ใบแจ้งซ่อม', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workorder-create">
    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => null,
    ]) ?>

</div>
