<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Customerinvoice $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="customerinvoice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'invoice_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trans_date')->textInput() ?>

    <?= $form->field($model, 'order_ref_id')->textInput() ?>

    <?= $form->field($model, 'total_amount')->textInput() ?>

    <?= $form->field($model, 'vat_amount')->textInput() ?>

    <?= $form->field($model, 'grand_total_amount')->textInput() ?>

    <?= $form->field($model, 'vat_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
