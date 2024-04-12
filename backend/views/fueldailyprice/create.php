<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Fueldailyprice $model */

$this->title = 'ราคาน้ำมันประจำวัน';
$this->params['breadcrumbs'][] = ['label' => 'ราคาน้ำมันประจำวัน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fueldailyprice-create">

    <?= $this->render('_form_new', [
        'model' => $model,
        'model_line' => null,
    ]) ?>

</div>
