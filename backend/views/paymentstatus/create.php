<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Paymentstatus $model */

$this->title = 'Create Paymentstatus';
$this->params['breadcrumbs'][] = ['label' => 'Paymentstatuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paymentstatus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
