<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Brand $model */

$this->title = 'สร้างยี่ห้อสินค้า';
$this->params['breadcrumbs'][] = ['label' => 'ยี่ห้อสินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
