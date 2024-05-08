<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Bankaccount $model */

$this->title = 'สร้างบัญชีธนาคาร';
$this->params['breadcrumbs'][] = ['label' => 'บัญชีธนาคาร', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bankaccount-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
