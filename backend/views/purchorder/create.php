<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Purchorder $model */

$this->title = 'สร้างคำสั่งซื้อ';
$this->params['breadcrumbs'][] = ['label' => 'คำสั่งซื้อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchorder-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_line'=>null,
    ]) ?>

</div>
