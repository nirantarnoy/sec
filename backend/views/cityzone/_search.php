<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\CityzoneSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cityzone-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'name')->textInput(['placeholder'=>'ค้นหา'])->label(false) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
