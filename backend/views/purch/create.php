<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Purch */

$this->title = 'สร้างใบสั่งซื้อ';
$this->params['breadcrumbs'][] = ['label' => 'ใบสั่งซื้อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purch-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_line'=> null
    ]) ?>

</div>
