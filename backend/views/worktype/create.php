<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Worktype $model */

$this->title = 'สร้างประเภทงาน';
$this->params['breadcrumbs'][] = ['label' => 'ประเภทงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worktype-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
