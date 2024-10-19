<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use toxor88\switchery\Switchery;

?>

<div class="vendor-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-1">

        </div>
        <div class="col-lg-10">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

            <?= $form->field($model, 'payment_method_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Paymentmethod::find()->all(), 'id', 'name'),
                'options' => [
                    'placeholder' => '--เลือก--'
                ]
            ]) ?>

            <?= $form->field($model, 'payment_term_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Paymentterm::find()->all(), 'id', 'name'),
                'options' => [
                    'placeholder' => '--เลือก--'
                ]
            ]) ?>

            <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className())->label(false) ?>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="col-lg-1">

        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
