<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\DropoffPlace $model */

$this->title = 'สร้างจุดขึ้นสินค้า';
$this->params['breadcrumbs'][] = ['label' => 'จุดขึ้นสินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dropoff-place-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
