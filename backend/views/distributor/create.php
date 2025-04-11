<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Distributor $model */

$this->title = 'สร้างข้อมูลบริษัทผู้นำเข้า';
$this->params['breadcrumbs'][] = ['label' => 'บริษัทผู้นำเข้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distributor-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
