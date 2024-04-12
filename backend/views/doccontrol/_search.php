<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\DoccontrolSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="doccontrol-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">
        <div class="col-lg-3"><?= $form->field($model, 'name') ?></div>
        <div class="col-lg-3">
            <?= $form->field($model, 'company_id')->widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Company::find()->all(), 'id', 'name'),
                'options' => [
                    'placeholder' => '--เลือก--'
                ]
            ]) ?>
        </div>
        <div class="col-lg-3">
            <?php $model->exp_date != null ? date('Y-m-d', strtotime($model->exp_date)) : date('Y-m-d'); ?>
            <?= $form->field($model, 'exp_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('Y-m-d'),
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy'
                ]
            ]) ?>
        </div>
        <div class="col-lg-3">
            <div style="height: 32px;"></div>
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
