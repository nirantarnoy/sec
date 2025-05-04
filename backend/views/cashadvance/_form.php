<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Cashadvance $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cashadvance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trans_date')->textInput() ?>

    <?= $form->field($model, 'team_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'in_amount')->textInput() ?>

    <?= $form->field($model, 'out_amount')->textInput() ?>

    <?= $form->field($model, 'balance_amount')->textInput() ?>

    <?= $form->field($model, 'work_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quotation_ref_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'distance_total')->textInput() ?>

    <?= $form->field($model, 'express_amount')->textInput() ?>

    <?= $form->field($model, 'line_total')->textInput() ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
