<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Vendor $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vendor-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'vendor_group_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>\yii\helpers\ArrayHelper::map(\backend\models\Vendorgroup::find()->all(),'id','name'),
                'options' => [

                ],
                'pluginOptions' => [
                    'allowClear'=> true,
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'payment_term_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>\yii\helpers\ArrayHelper::map(\backend\models\Paymentterm::find()->all(),'id','name'),
                'options' => [

                ],
                'pluginOptions' => [
                    'allowClear'=> true,
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'payment_method_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>\yii\helpers\ArrayHelper::map(\backend\models\Paymentmethod::find()->all(),'id','name'),
                'options' => [

                ],
                'pluginOptions' => [
                    'allowClear'=> true,
                ]
            ]) ?>
        </div>
    </div>


    <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
