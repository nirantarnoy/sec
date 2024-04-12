<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Routeplan $model */

$this->title = 'สร้างจัดการปลายทาง';
$this->params['breadcrumbs'][] = ['label' => 'จัดการปลายทาง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="routeplan-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
