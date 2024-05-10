<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Deliveryorder $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="deliveryorder-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'order_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'trans_date')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'issue_ref_id')->textInput() ?>
        </div>
        <div class="col-lg-3"></div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12"><h5>รายละเอียด</h5></div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
