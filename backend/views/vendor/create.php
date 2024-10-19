<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Vendor */

$this->title = 'สร้างข้อมูลผู้ขาย';
$this->params['breadcrumbs'][] = ['label' => 'ผู้ขาย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
