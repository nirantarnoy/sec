<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Recieptrecord $model */

$this->title = 'สร้างบันทึกรับ';
$this->params['breadcrumbs'][] = ['label' => 'บันทึกรับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recieptrecord-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
