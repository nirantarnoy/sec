<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

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
           <?= $form->field($model, 'product_cat_id')->widget(\kartik\select2\Select2::className(),[
               'data'=>\yii\helpers\ArrayHelper::map(\backend\models\Productgroup::find()->all(),'id','name'),
               'options' => [

               ],
               'pluginOptions' => [
                   'allowClear'=> true,
               ]
           ]) ?>
       </div>
       <div class="col-lg-4">
           <?= $form->field($model, 'last_price')->textInput() ?>
       </div>
   </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'std_price')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3"></div>
    </div>















    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
