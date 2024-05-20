<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Company $model */

$this->title = 'สร้างข้อมูลบริษัท';
$this->params['breadcrumbs'][] = ['label' => 'บริษัท', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
