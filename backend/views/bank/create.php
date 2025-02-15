<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Bank $model */

$this->title = 'สร้างธนาคาร';
$this->params['breadcrumbs'][] = ['label' => 'ธนาคาร', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
