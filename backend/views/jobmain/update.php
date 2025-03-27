<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Jobmain $model */

$this->title = 'แก้ไขใบงาน: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'รายการใบงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="jobmain-update">

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'perpage' => $perpage,
    ]) ?>

</div>
