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
            <?php $model->trans_date=$model->isNewRecord ? date('d/m/Y') : date('d/m/Y',strtotime($model->trans_date)); ?>
            <?= $form->field($model, 'trans_date')->widget(\kartik\date\DatePicker::className(),[
                    'value' => date('d/m/Y')
            ]) ?>
        </div>
        <div class="col-lg-3">
            <label for="">เลขที่ใบเบิก</label>
            <input type="text" class="form-control" readonly value="<?=\backend\models\Journalissue::findJournalNo($model->issue_ref_id)?>">
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'issue_ref_id')->hiddenInput()->label(false) ?>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12"><h5>จัดการสินค้าที่ต้องจัดส่ง</h5></div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-bordered" id="table-list-top">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 25%;">รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th style="width: 10%;">จำนวนเบิก</th>
                    <th style="width: 10%;">จำนวน/กล่อง</th>
                    <th style="width: 10%;">จำนวนกล่อง</th>
                    <th style="width: 10%;">จำนวนเศษ</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($model_cal_line != null): ?>
                    <?php $line_num_cal = 0; ?>
                    <?php foreach ($model_cal_line as $value_cal): ?>
                        <?php $line_num_cal += 1; ?>
                        <tr data-var="<?= $value_cal->id ?>">
                            <td style="text-align: center;"><?= $line_num_cal; ?></td>
                            <td>
                                <input type="hidden" name="line_rec_id[]" value="<?= $value_cal->id ?>">
                                <input type="hidden" class="line-product-id" name="line_product_id[]"
                                       value="<?= $value_cal->product_id ?>">
                                <input type="text" class="form-control line-product-code"
                                       name="line_product_code[]"
                                       value="<?= \backend\models\Product::findCode($value_cal->product_id) ?>"
                                       readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control line-product-name"
                                       name="line_product_name[]"
                                       value="<?= $value_cal->name?>"
                                >
                            </td>

                            <td>
                                <input type="number" class="form-control line-qty" name="line_qty[]"
                                       value="<?= $value_cal->qty ?>"
                                       onchange="linecalx($(this))">
                            </td>
                            <td>
                                <input type="number" class="form-control line-qty" name="line_qty[]"
                                       value="<?= $value_cal->qty ?>"
                                       onchange="linecalx($(this))">
                            </td>
                            <td>
                                <input type="number" class="form-control line-qty" name="line_qty[]"
                                       value="<?= $value_cal->qty ?>"
                                       onchange="linecalx($(this))">
                            </td>
                            <td>
                                <input type="number" class="form-control line-qty" name="line_qty[]"
                                       value="<?= $value_cal->qty ?>"
                                       onchange="linecalx($(this))">
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr data-var="0">
                        <td style="text-align: center;"></td>
                        <td>
                            <input type="hidden" name="line_rec_id[]" value="0">
                            <input type="hidden" class="line-product-id" name="line_product_id[]"
                                   value="">
                            <input type="text" class="form-control line-product-code"
                                   name="line_product_code[]"
                                   value=""
                                   readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control line-product-name"
                                   name="line_product_name[]"
                                   value=""
                            >
                        </td>

                        <td>
                            <input type="number" class="form-control line-qty" name="line_qty[]"
                                   value="0"
                                   onchange="linecalx($(this))">
                        </td>
                        <td>
                            <input type="number" class="form-control line-qty" name="line_qty[]"
                                   value="0"
                                   onchange="linecalx($(this))">
                        </td>
                        <td>
                            <input type="number" class="form-control line-qty" name="line_qty[]"
                                   value="0"
                                   onchange="linecalx($(this))">
                        </td>
                        <td>
                            <input type="number" class="form-control line-qty" name="line_qty[]"
                                   value="0"
                                   onchange="linecalx($(this))">
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
                <tfoot>
                <tr>

                    <td colspan="3">
                        <button type="button" class="btn btn-info btn-sm" onclick="addline()">จัดสินค้า</button>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12"><h5>รายละเอียด</h5></div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%;">รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>รายละเอียด</th>
                    <th style="width: 15%;">จำนวน</th>
                    <th style="width: 10%;">หน่วยนับ</th>
                </tr>
                </thead>
                <tbody>
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
                                       value="<?= $value->name?>"
                                >
                            </td>
                            <td>
                                <input type="text" class="form-control line-product-name-description"
                                       name="line_product_name_description[]"
                                       value="<?= $value->description?>"
                                >
                            </td>

                            <td>
                                <input type="number" class="form-control line-qty" name="line_qty[]"
                                       value="<?= $value->qty ?>"
                                       onchange="linecal($(this))">
                            </td>
                            <td style="text-align: center;">
                                ชิ้น
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr data-var="0">
                        <td style="text-align: center;"></td>
                        <td>
                            <input type="hidden" name="line_rec_id[]" value="0">
                            <input type="hidden" class="line-product-id" name="line_product_id[]"
                                   value="">
                            <input type="text" class="form-control line-product-code"
                                   name="line_product_code[]"
                                   value=""
                                   readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control line-product-name"
                                   name="line_product_name[]"
                                   value=""
                            >
                        </td>
                        <td>
                            <input type="text" class="form-control line-product-name-description"
                                   name="line_product_name_description[]"
                                   value=""
                            >
                        </td>
                        <td>
                            <input type="number" class="form-control line-qty" name="line_qty[]"
                                   value="0"
                                   onchange="linecal($(this))">
                        </td>
                        <td style="text-align: center;">
                            ชิ้น
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label for="">หมายเหตุ</label>
            <?= $form->field($model, 'remark')->textarea()->label(false) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
