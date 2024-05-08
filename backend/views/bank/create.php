<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Bank $model */

$this->title = 'สร้างข้อมูลธนาคาร';
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลธนาคาร', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
