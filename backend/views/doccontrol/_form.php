<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Doccontrol $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="doccontrol-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-9">
            <?= $form->field($model, 'description') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'company_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>\yii\helpers\ArrayHelper::map(\backend\models\Company::find()->all(),'id','name'),
                'options' => [
                    'placeholder'=>'--เลือก--'
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?php $model->start_date = $model->isNewRecord ? date('Y-m-d'):date('Y-m-d',strtotime($model->start_date))?>
            <?php  echo $form->field($model, 'start_date')->widget(\kartik\date\DatePicker::className(),[
                    'value' => date('Y-m-d'),
                    'options' => [

                    ],
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy'
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?php $model->exp_date = $model->isNewRecord ? date('Y-m-d'):date('Y-m-d',strtotime($model->exp_date))?>
            <?php  echo $form->field($model, 'exp_date')->widget(\kartik\date\DatePicker::className(),[
                'value' => date('Y-m-d'),
                'options' => [

                ],
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy'
                ]
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'doc_file')->fileInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
