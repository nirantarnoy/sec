<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Mainconfig $model */

$this->title = 'ตั้งค่าระบบ';
$this->params['breadcrumbs'][] = ['label' => 'ตั้งค่าระบบ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mainconfig-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
