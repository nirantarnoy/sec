<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\CashadvanceSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cashadvance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'trans_date') ?>

    <?= $form->field($model, 'team_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'in_amount') ?>

    <?php // echo $form->field($model, 'out_amount') ?>

    <?php // echo $form->field($model, 'balance_amount') ?>

    <?php // echo $form->field($model, 'work_name') ?>

    <?php // echo $form->field($model, 'quotation_ref_no') ?>

    <?php // echo $form->field($model, 'distance_total') ?>

    <?php // echo $form->field($model, 'express_amount') ?>

    <?php // echo $form->field($model, 'line_total') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
