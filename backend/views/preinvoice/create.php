<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Preinvoice $model */

$this->title = 'สร้างใบรวมบิล';
$this->params['breadcrumbs'][] = ['label' => 'รวมบิล', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preinvoice-create">
    <?= $this->render('_form', [
        'model' => $model,
        'model_line'=> null,
    ]) ?>

</div>
