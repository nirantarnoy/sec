<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Journalreceive $model */
/** @var yii\widgets\ActiveForm $form */

$warehouse_data = \backend\models\Warehouse::find()->where(['status' => 1])->all();
?>

<div class="journalreceive-form">

    <?php $form = ActiveForm::begin(); ?>

    <input type="hidden" name="removelist" class="remove-list" value="">
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'journal_no')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
        </div>
        <div class="col-lg-4">
            <?php $model->trans_date = $model->isNewRecord ? date('d-m-Y') : date('d-m-Y', strtotime($model->trans_date)) ?>
            <?= $form->field($model, 'trans_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('d-m-Y'),
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy'
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-4">
            <?php //echo $form->field($model, 'status')->textInput() ?>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered" id="table-list">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%">รหัสสินค้า</th>
                    <th>รายละเอียด</th>
                    <th style="width: 10%;text-align: left;">คลังสินค้า</th>
                    <th style="width: 10%;text-align: right;">วันหมดอายุ</th>
                    <th style="width: 10%;text-align: right;">จำนวนรับ</th>
                    <th style="width: 15%;text-align: left;">หมายเหตุ</th>
                    <th style="width: 5%;text-align: center;">-</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($model->isNewRecord): ?>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" class="line-product-id" name="line_product_id[]" value="">
                            <input type="text" class="form-control line-product-code" name="line_product_code[]"
                                   value="" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control line-product-name" name="line_product_name[]"
                                   value="" readonly>
                        </td>
                        <td>

                            <select class="form-control" name="line_warehouse_id[]"
                                    id="line-product-warehouse-id" onchange="">
                                <option value="-1">--เลือกคลัง--</option>
                                <?php foreach ($warehouse_data as $value_wh): ?>

                                    <option value="<?= $value_wh->id ?>"><?= $value_wh->name ?></option>
                                <?php endforeach; ?>
                            </select>

                        </td>
                        <td>
                            <input type="text" class="form-control line-expire-date" name="line_expire_date[]" value="">
                        </td>
                        <td>
                            <input type="number" class="form-control line-qty" name="line_qty[]" min="0" value=""
                                   onchange="linecal($(this))">
                        </td>
                        <td>
                            <input type="text" class="form-control line-remark" name="line_remark[]" value="">
                        </td>
                        <td>
                            <div class="btn btn-sm btn-danger" onclick="removeline($(this))"><i
                                        class="fa fa-trash"></i>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php if ($model_line != null): ?>
                        <?php $line_num = 0; ?>
                        <?php foreach ($model_line as $value): ?>
                            <?php $line_num += 1; ?>
                            <tr data-var="<?= $value->id ?>">
                                <td style="text-align: center;"><?= $line_num; ?></td>
                                <td>
                                    <input type="hidden" name="line_rec_id[]" value="<?= $value->id ?>">
                                    <input type="hidden" class="line-product-id" name="line_product_id[]"
                                           value="<?= $value->product_id ?>">
                                    <input type="text" class="form-control line-product-code"
                                           name="line_product_code[]"
                                           value="<?= \backend\models\Product::findCode($value->product_id) ?>"
                                           readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control line-product-name"
                                           name="line_product_name[]"
                                           value="<?= \backend\models\Product::findName($value->product_id) ?>"
                                    >
                                </td>
                                <td>
                                    <select class="form-control" name="line_warehouse_id[]"
                                            id="line-product-warehouse-id" onchange="pullstocksum($(this))">
                                        <option value="-1">--เลือกคลัง--</option>
                                        <?php foreach ($warehouse_data as $value_wh): ?>
                                            <?php $selected = ($value_wh->id == $value->warehouse_id) ? 'selected' : ''; ?>
                                            <option value="<?= $value_wh->id ?>" <?= $selected ?>><?= $value_wh->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control line-remark" name="line_remark[]" value="">
                                </td>
                                <td>
                                    <input type="number" class="form-control line-qty" name="line_qty[]"
                                           value="<?= $value->qty ?>"
                                           onchange="linecal($(this))">
                                </td>
                                <td>
                                    <input type="text" class="form-control line-remark" name="line_remark[]"
                                           value="<?= $value->remark ?>">
                                </td>
                                <td>
                                    <?php if ($model->isNewRecord): ?>
                                        <div class="btn btn-sm btn-danger" onclick="removeline($(this))"><i
                                                    class="fa fa-trash"></i>
                                        </div>
                                    <?php elseif (!$model->isNewRecord && $value->status != 3): ?>
                                        <div class="btn btn-sm btn-secondary" onclick="cancelline($(this))">ยกเลิก
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td></td>
                            <td>
                                <input type="hidden" class="line-product-id" name="line_product_id[]" value="">
                                <input type="text" class="form-control line-product-code" name="line_product_code[]"
                                       value="" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control line-product-name" name="line_product_name[]"
                                       value="" readonly>
                            </td>
                            <td>

                                <select class="form-control" name="line_warehouse_id[]"
                                        id="line-product-warehouse-id" onchange="">
                                    <option value="-1">--เลือกคลัง--</option>
                                    <?php foreach ($warehouse_data as $value_wh): ?>

                                        <option value="<?= $value_wh->id ?>"><?= $value_wh->name ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </td>
                            <td>
                                <input type="text" class="form-control line-expire-date" name="line_expire_date[]" value="">
                            </td>
                            <td>
                                <input type="number" class="form-control line-qty" name="line_qty[]" min="0" value=""
                                       onchange="linecal($(this))">
                            </td>
                            <td>
                                <input type="text" class="form-control line-remark" name="line_remark[]" value="">
                            </td>
                            <td>
                                <div class="btn btn-sm btn-danger" onclick="removeline($(this))"><i
                                            class="fa fa-trash"></i>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>

                </tbody>
                <tfoot>
                <tr>
                    <td style="text-align: center;">
                        <!--                            <div class="btn btn-sm btn-primary" onclick="finditem();"><i class="fa fa-plus"></i></div>-->
                    </td>
                    <td colspan="4" style="text-align: right">รวม</td>
                    <td>
                        <input type="text" class="form-control qty-all-total" value="0"
                               readonly>
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
