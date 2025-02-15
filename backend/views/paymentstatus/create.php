<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Paymentstatus $model */

$this->title = 'สร้างสถานะชำระเงิน';
$this->params['breadcrumbs'][] = ['label' => 'สถานะชำระเงิน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paymentstatus-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
