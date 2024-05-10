<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Customerinvoice $model */

$this->title = 'สร้างใบกำกับภาษี';
$this->params['breadcrumbs'][] = ['label' => 'ใบกำกับภาษี', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customerinvoice-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => null,
    ]) ?>

</div>
