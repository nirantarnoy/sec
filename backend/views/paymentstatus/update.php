<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Paymentstatus $model */

$this->title = 'Update Paymentstatus: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Paymentstatuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="paymentstatus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
