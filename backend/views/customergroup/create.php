<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Customergroup $model */

$this->title = 'สร้างกลุ่มลูกค้า';
$this->params['breadcrumbs'][] = ['label' => 'กลุ่มลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customergroup-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
