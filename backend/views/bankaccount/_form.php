<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Bankaccount $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="bankaccount-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-lg-1">

        </div>
        <div class="col-lg-10">
            <?= $form->field($model, 'account_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'bank_id')->widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Bank::find()->all(), 'id', 'name'),
                'options' => [
                    'placeholder' => 'เลือกธนาคาร',
                ],
                'pluginOptions' => [
                        'allowClear' => true,
                ]
            ]) ?>

            <?= $form->field($model, 'account_no')->textInput(['maxlength' => true]) ?>


            <label for=""><?= $model->getAttributeLabel('status') ?></label>
            <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label(false) ?>

            <br>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
