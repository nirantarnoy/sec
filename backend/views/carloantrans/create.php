<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Carloantrans $model */

$this->title = 'สร้างรายการบันทึกค่างวด';
$this->params['breadcrumbs'][] = ['label' => 'บันทึกชำระค่างวด', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carloantrans-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
