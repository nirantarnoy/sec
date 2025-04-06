<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Jobmain $model */

$this->title = 'สร้างใบงาน';
$this->params['breadcrumbs'][] = ['label' => 'รายการใบงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobmain-create">
    <?= $this->render('_form', [
        'model' => $model,
        'dataProvider' => null,
        'searchModel' => null,
    ]) ?>

</div>
