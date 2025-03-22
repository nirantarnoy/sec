<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Distributor $model */

$this->title = 'สร้างข้อมูลผู้นำเข้าหลัก';
$this->params['breadcrumbs'][] = ['label' => 'ผู้นำเข้าหลัก', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distributor-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
