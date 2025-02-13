<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Worktype $model */

$this->title = 'Update Worktype: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Worktypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="worktype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
