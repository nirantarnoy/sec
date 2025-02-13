<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Worktype $model */

$this->title = 'Create Worktype';
$this->params['breadcrumbs'][] = ['label' => 'Worktypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worktype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
