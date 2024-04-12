<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Item $model */

$this->title = 'สร้างของนำกลับ';
$this->params['breadcrumbs'][] = ['label' => 'ของนำกลับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
