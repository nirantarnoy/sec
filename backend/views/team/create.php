<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Team $model */

$this->title = 'สร้างทีม';
$this->params['breadcrumbs'][] = ['label' => 'ทีม', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => null,
    ]) ?>

</div>
