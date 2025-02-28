<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Jobdeduct $model */

$this->title = 'Update Jobdeduct: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jobdeducts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jobdeduct-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
