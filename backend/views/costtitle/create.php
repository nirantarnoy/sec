<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\FixcostTitle $model */

$this->title = 'สร้างรายการค่าใช้จ่าย';
$this->params['breadcrumbs'][] = ['label' => 'รายการค่าใช้จ่าย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fixcost-title-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
