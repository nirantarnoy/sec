<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Doccontrol $model */

$this->title = 'สร้างเอกสาร';
$this->params['breadcrumbs'][] = ['label' => 'เอกสาร', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doccontrol-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
