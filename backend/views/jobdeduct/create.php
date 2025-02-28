<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Jobdeduct $model */

$this->title = 'Create Jobdeduct';
$this->params['breadcrumbs'][] = ['label' => 'Jobdeducts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobdeduct-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
