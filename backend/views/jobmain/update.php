<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Jobmain $model */

$this->title = 'Update Jobmain: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jobmains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jobmain-update">

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'perpage' => $perpage,
    ]) ?>

</div>
