<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'barcode')->textInput(['maxlength' => true]) ?>
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
        <div class="col-lg-3">
            <?= $form->field($model, 'product_group_id')->widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Productgroup::find()->all(), 'id', 'name'),
                'options' => [

                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'cost_price')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'sale_price')->textInput() ?>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-3">
            <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>
        </div>
        <div class="col-lg-3"></div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-6">
            <label for="">รูปภาพ</label>
            <?php if ($model->isNewRecord): ?>
                <table style="width: 100%">
                    <tr>
                        <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                            <i class="fa fa-ban fa-lg" style="color: grey"></i>
                            <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                        </td>
                    </tr>
                </table>
            <?php else: ?>
                <table style="width: 100%">
                    <tr>
                        <?php if ($model->photo != ''): ?>
                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                <a href="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo ?>"
                                   target="_blank"><img
                                            src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo ?>"
                                            style="max-width: 130px;margin-top: 5px;" alt=""></a>
                            </td>
                        <?php else: ?>
                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                            </td>
                        <?php endif; ?>
                    </tr>
                </table>
            <?php endif; ?>
            <input type="file" name="product_photo" class="form-control">
        </div>

    </div>
    <br />

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
