<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Deliveryorder $model */

$this->title = 'สร้างใบส่งของ';
$this->params['breadcrumbs'][] = ['label' => 'ใบส่งของ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deliveryorder-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => null,
    ]) ?>

</div>
