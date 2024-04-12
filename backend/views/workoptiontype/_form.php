<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\WorkOptionType $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="work-option-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>
    <br/>
    <h4>ข้อมูลการวางบิล</h4>
    <div class="row">
        <div class="col-lg-4">
            <div class="label">เงื่อนไขการชำระเงิน</div>
            <?php
              echo \kartik\select2\Select2::widget([
                      'data'=>\yii\helpers\ArrayHelper::map(\backend\models\Paymentterm::find()->all(),'id','name'),
                      'name'=>'customer_payment_term_id',
                      'value' => $model_work_type_tax_info !=null ?$model_work_type_tax_info->payment_term_id: 0,
              ])
            ?>
        </div>
        <div class="col-lg-4">
            <div class="label">วิธีชำระเงิน</div>
            <?php
            echo \kartik\select2\Select2::widget([
                'data'=>\yii\helpers\ArrayHelper::map(\backend\models\Paymentmethod::find()->all(),'id','name'),
                'name'=>'customer_payment_method_id',
                'value' => $model_work_type_tax_info !=null ? $model_work_type_tax_info->payment_method_id: 0,
            ])
            ?>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-4">
            <div class="label">เลขผู้เสียภาษี</div>
            <input type="text" class="form-control" name="customer_tax_id" value="<?=$model_work_type_tax_info !=null?$model_work_type_tax_info->tax_id:'';?>">
        </div>
        <div class="col-lg-4">
            <div class="label">สาขา</div>
            <input type="text" class="form-control" name="customer_tax_branch" value="<?=$model_work_type_tax_info !=null?$model_work_type_tax_info->branch:'';?>">
        </div>
        <div class="col-lg-4">
            <div class="label">ชื่อผู้ติดต่อ</div>
            <input type="text" class="form-control" name="customer_tax_contact_name" value="<?=$model_work_type_tax_info !=null?$model_work_type_tax_info->contact_name:'';?>">
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-4">
            <div class="label">เบอร์โทร</div>
            <input type="text" class="form-control" name="customer_tax_phone" value="<?=$model_work_type_tax_info !=null?$model_work_type_tax_info->phone:'';?>">
        </div>
        <div class="col-lg-4">
            <div class="label">อีเมล</div>
            <input type="text" class="form-control" name="customer_tax_email" value="<?=$model_work_type_tax_info !=null?$model_work_type_tax_info->email:'';?>">
        </div>
        <div class="col-lg-4">
            <div class="label">ที่อยู่</div>
            <input type="text" class="form-control" name="customer_tax_address" value="<?=$model_work_type_tax_info !=null?$model_work_type_tax_info->address:'';?>">
        </div>
    </div>
    <br/>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
