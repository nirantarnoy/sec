<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Vendorgroup $model */

$this->title = 'สร้างกลุ่มผู้ขาย';
$this->params['breadcrumbs'][] = ['label' => 'กลุ่มผู้ขาย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendorgroup-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
