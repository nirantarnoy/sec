<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Cashrecord $model */

$this->title = 'สร้างบันทึกเงินสด';
$this->params['breadcrumbs'][] = ['label' => 'บันทึกเงินสด', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashrecord-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
