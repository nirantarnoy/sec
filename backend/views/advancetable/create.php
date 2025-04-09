<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Advancetable $model */

$this->title = 'บันทึกรายการ Cash Advance';
$this->params['breadcrumbs'][] = ['label' => 'Cash Advance', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advancetable-create">
    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => $model_line
    ]) ?>

</div>
