<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Customerinvoice $model */

$this->title = 'สร้างใบวางบิล';
$this->params['breadcrumbs'][] = ['label' => 'วางบิล', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customerinvoice-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelline'=> $modelline,
    ]) ?>

</div>
