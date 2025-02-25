<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Deductitem $model */

$this->title = 'สร้างห้วข้อค่าใช้จ่าย';
$this->params['breadcrumbs'][] = ['label' => 'ห้วข้อค่าใช้จ่าย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deductitem-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
