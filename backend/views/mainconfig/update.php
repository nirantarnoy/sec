<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Mainconfig $model */

$this->title = 'ตั้งค่าระบบ: ';
//$this->params['breadcrumbs'][] = ['label' => 'ตั้งค่าระบบ', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="mainconfig-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
