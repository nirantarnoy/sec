<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Cityzone $model */

$this->title = 'สร้างโซนพื้นที่';
$this->params['breadcrumbs'][] = ['label' => 'โซนพื้นที่', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cityzone-create">

    <?= $this->render('_form', [
        'model' => $model,
        'zone_line_data'=> null,
        'zone_line_district_data'=> null,
    ]) ?>

</div>
