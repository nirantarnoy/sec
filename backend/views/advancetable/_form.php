<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Advancetable $model */
/** @var yii\widgets\ActiveForm $form */
$model_table_line = \common\models\CashAdvance::find()->where(['advance_master_id' => $model->id])->orderBy(['trans_date' => SORT_DESC])->all();
?>

<div class="advancetable-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'trans_month')->hiddenInput(['readonly' => 'readonly', 'value' => (int)date('m')])->label(false) ?>
    <div class="row">
        <div class="col-lg-2">
            <?= $form->field($model, 'trans_year')->textInput(['readonly' => 'readonly', 'value' => (int)date('Y')]) ?>
        </div>
        <div class="col-lg-3">
            <label for="">เดือน</label>
            <input type="text" class="form-control" value="<?= \backend\helpers\MonthData::getTypeById((int)date('m')) ?>"
                   readonly="readonly">
        </div>
        <div class="col-lg-4">
            <label for="">ทีม</label>
            <input type="text" class="form-control" value="<?= \backend\models\Team::findName(1) ?>"
                   readonly="readonly">
            <?= $form->field($model, 'team_id')->hiddenInput(['value' => 1])->label(false) ?>
        </div>
<!--        <div class="col-lg-3">-->
<!--            --><?php //= $form->field($model, 'advance_amount')->textInput(['value' => $model->isNewRecord ?0:$model->advance_amount]) ?>
<!--        </div>-->
        <div class="col-lg-3">
            <?= $form->field($model, 'total_balance')->textInput(['readonly' => 'readonly', 'value' => $model->isNewRecord ?0:$model->total_balance]) ?>
        </div>
    </div>
    <br/>

    <?php if (!$model->isNewRecord): ?>
        <?php $model_table_line = \common\models\CashAdvance::find()->where(['advance_master_id' => $model->id])->all(); ?>
        <?= $form->field($model_line, 'advance_master_id')->hiddenInput(['value' => $model->id])->label(false) ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <b><h4>รายการรับจ่าย</h4></b>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-3">
                <?php $model_line->trans_date = date('d-m-Y'); ?>
                <?= $form->field($model_line, 'trans_date')->widget(\kartik\date\DatePicker::className(), [
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'todayHighlight' => true
                    ]
                ]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model_line, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model_line, 'in_amount')->textInput(['type' => 'number','value'=>0]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model_line, 'out_amount')->textInput(['type' => 'number','value'=>0]) ?>
            </div>

            <div class="col-lg-3">
                <?= $form->field($model_line, 'quotation_ref_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model_line, 'work_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model_line, 'distance_total')->textInput(['type' => 'number','value'=>0]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model_line, 'express_amount')->textInput(['type' => 'number','value'=>0]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model_line, 'line_total')->textInput(['readonly' => 'readonly']) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model_line, 'remark')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?php if (!$model->isNewRecord): ?>
                    <div class="form-group">
                        <?= Html::submitButton('เพิ่มรายการในตาราง', ['class' => 'btn btn-primary']) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <br/>
        <div class="row">
            <div class="col-lg-12">
                <div style="overflow: scroll;">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th style="background-color: lightgreen;text-align: center;width: 10%">วันที่</th>
                            <th style="background-color: lightgreen;width: 15%;">รายการ</th>
                            <th style="text-align: right;background-color: lightgreen;">รับ</th>
                            <th style="text-align: right;background-color: lightgreen;">จ่าย</th>
                            <th style="text-align: right;background-color: lightgreen;">คงเหลือ</th>
                            <th style="background-color: lightgreen;">เลขที่ใบเสนอราคา</th>
                            <th style="background-color: lightgreen;">ชื่อลูกค้า</th>
                            <th style="text-align: right;background-color: lightgreen;">ระยะทางรวม</th>
                            <th style="text-align: right;background-color: lightgreen;">ค่าทางด่วน</th>
                            <th style="text-align: right;background-color: lightgreen;">รวม</th>
                            <th style="background-color: lightgreen;">หมายเหตุ</th>
                            <th style="width: 5%;background-color: lightgreen"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($model_table_line != null): ?>
                        <?php foreach($model_table_line as $line): ?>
                        <tr data-var="<?=$line->id;?>">
                            <td style="text-align: center;"><?=date('d-m-Y',strtotime($line->trans_date))?></td>
                            <td><?=$line->name?></td>
                            <td style="text-align: right;color: green;"><?=number_format($line->in_amount,2)?></td>
                            <td style="text-align: right;color: red;"><?=number_format($line->out_amount,2)?></td>
                            <td style="text-align: right;background-color: lightgrey;"><?=number_format($line->balance_amount,2)?></td>
                            <td><?=$line->quotation_ref_no?></td>
                            <td><?=$line->work_name?></td>
                            <td style="text-align: right;"><?=$line->distance_total?></td>
                            <td style="text-align: right;"><?=$line->express_amount?></td>
                            <td style="text-align: right;background-color: lightgrey;"><?=number_format($line->line_total,2)?></td>
                            <td><?=$line->remark?></td>
                            <td style="text-align: center;"><div class="btn btn-sm btn-danger" onclick="removeline($(this))">ลบ</div></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endif; ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    <?php endif; ?>

    <?php if ($model->isNewRecord): ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>


<?php
$url_to_delete_cash_advance = \yii\helpers\Url::to(['advancetable/deletecashadvance'], true);
$js=<<<JS
$(function(){
    
});
function removeline(e){
    var line_id = e.parent().parent().attr("data-var");
    if(line_id != null){
        if(confirm("ต้องการลบข้อมูลใช่หรือไม่?")){
            $.ajax({
                url: '$url_to_delete_cash_advance',
                type: 'POST',
                dataType: 'html',
                data: {'line_id': line_id},
                success: function (data) {
                    window.location.reload();
                    // alert(data);
                },
                error: function (err) {
                    
                }
            });
        }
    }
 }
JS;

$this->registerJs($js, static::POS_END);
?>