<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Quotation $model */

$this->title = 'สร้างใบเสนอราคา';
$this->params['breadcrumbs'][] = ['label' => 'ใบเสนอราคา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotation-create">
    <?= $this->render('_form', [
        'model' => $model,
        'model_line'=> null
    ]) ?>

</div>
