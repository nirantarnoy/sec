<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CarBrand $model */

$this->title = 'สร้างยี่ห้อรถใหม่';
$this->params['breadcrumbs'][] = ['label' => 'ยี่ห้อรถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-brand-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
