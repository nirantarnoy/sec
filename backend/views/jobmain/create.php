<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Jobmain $model */

$this->title = 'Create Jobmain';
$this->params['breadcrumbs'][] = ['label' => 'Jobmains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobmain-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
