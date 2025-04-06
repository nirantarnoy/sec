<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Job $model */
/** @var yii\widgets\ActiveForm $form */

$product_as_service = \common\models\CostCalType::find()->all();
//$distributor_data = \common\models\Distributor::find()->where(['status' => 1])->orderBy(['can_new' => SORT_ASC])->all();

?>
    <div class="row">
        <div class="col-lg-12" style="text-align: right;">
            <div class="btn btn-info" onclick="copyJob(<?= $model->id ?>)"><i class="fa fa-copy"> </i> Copy ใบงานนี้</div>
        </div>
    </div>
    <input type="hidden" class="model-id" value="<?= $model->id ?>">
    <div class="job-form">
        <?php $form = ActiveForm::begin(['options' => ['id' => 'form-job']]); ?>
        <input type="hidden" class="remove-list" name="removelist" value="">
        <br/>
        <h5><b>ข้อมูลลูกค้า / Customer information</b></h5>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'job_no')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'quotation_ref_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'invoice_ref_no')->textInput(['maxlength' => true]) ?>
                <!--                --><?php //$model->trans_date = $model->isNewRecord ? date('d-m-Y') : date('d-m-Y', strtotime($model->trans_date)); ?>
                <!--                --><?php //= $form->field($model, 'trans_date')->widget(\kartik\date\DatePicker::className(), [
                //                    'pluginOptions' => [
                //                        'format' => 'dd-mm-yyyy',
                //                    ]
                //                ]) ?>
            </div>
            <div class="col-lg-3">

                <?= $form->field($model, 'customer_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Customer::find()->where(['status' => 1])->all(), 'id', function ($data) {
                        return $data->first_name . ' ' . $data->last_name;
                    }),
                    'options' => ['placeholder' => 'Select a customer ...'],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>

            </div>
        </div>
        <br/>
        <h5><b>ข้อมูลผู้รับผิดชอบ / Staff information</b></h5>
        <div class="row" style="background-color: lightblue;padding: 8px;">
            <div class="col-lg-3">
                <?= $form->field($model, 'team_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Team::find()->where(['status' => 1, 'team_type_id' => 1])->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select a team ...', 'onchange' => 'getemployee($(this));'],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?php if ($model->isNewRecord): ?>
                    <?= $form->field($model, 'head_id')->widget(\kartik\select2\Select2::className(), [
                        'data' => null,
                        'options' => ['placeholder' => 'Select a head ...', 'class' => 'selected-head-id'],
                        'pluginOptions' => ['allowClear' => true],
                    ]) ?>
                <?php else: ?>
                    <?= $form->field($model, 'head_id')->widget(\kartik\select2\Select2::className(), [
                        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Employee::find()->where(['status' => 1])->all(), 'id', function ($data) {
                            return $data->f_name . ' ' . $data->l_name;
                        }),
                        'options' => ['placeholder' => 'Select a head ...', 'class' => 'selected-head-id'],
                        'pluginOptions' => ['allowClear' => true],
                    ]) ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'job_type_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\WorkType::find()->where(['status' => 1])->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select a Job type ...',],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'status')->textInput(['readonly' => 'readonly', 'value' => $model->isNewRecord ? 'Open' : \backend\helpers\JobStatus::getTypeById($model->status)]) ?>
            </div>
        </div>
        <div class="row" style="background-color: lightblue;padding: 8px;">

            <div class="col-lg-3">
                <?= $form->field($model, 'install_team_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Team::find()->where(['status' => 1, 'team_type_id' => 2])->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select a team ...',],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'main_distributor_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Distributor::find()->where(['status' => 1, 'can_new' => 0])->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select',],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
            </div>
        </div>
        <br/>
        <h5><b>ข้อมูลการชำระเงิน / Payment Information</b></h5>
        <div class="row" style="background-color: lightblue;padding: 8px;">
            <div class="col-lg-3">
                <?= $form->field($model, 'paid_amount')->textInput(['maxlength' => true, 'readonly' => 'readonly', 'value' => number_format(getJobpayment($model->id, 3))]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'withholding_amount')->textInput(['maxlength' => true, 'readonly' => 'readonly', 'value' => number_format(getWithholdingAmount($model->id, 3))]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'pending_amount')->textInput(['maxlength' => true, 'readonly' => 'readonly', 'value' => number_format(getPaidPending($model->id), 3)]) ?>
                <?= $form->field($model, 'set_to_zero')->widget(\toxor88\switchery\Switchery::className())->label(false) ?>
            </div>
            <div class="col-lg-3">
                <label for="">สถานะการจ่ายเงิน/Payment Status</label>
                <?php
                $status_color = 'background-color: red;color: white;';
                if ($model->payment_status == 2) {
                    $status_color = 'background-color: yellow;color: black;';
                } else if ($model->payment_status == 3) {
                    $status_color = 'background-color: green;color: white;';
                }
                ?>
                <input type="text" class="form-control" style="<?= $status_color ?>" readonly
                       value="<?= \backend\models\PaymentStatus::findName($model->payment_status) ?>">
            </div>
        </div>
        <br/>
        <h5><b>ข้อมูลรายการขายสินค้า / Product Sales Information</b></h5>
        <div class="row" style="background-color: lightblue;padding: 8px;">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <label for="">รายการสินค้า</label>
                        <?php
                        echo \kartik\select2\Select2::widget([
                            'name' => 'product_id',
                            'data' => \yii\helpers\ArrayHelper::map(\backend\models\Product::find()->where(['status' => 1])->all(), 'id', 'name'),
                            'id' => 'product-id',
                            'options' => ['class' => 'form-control product-id', 'placeholder' => 'เลือกรายการสินค้า ...', 'onchange' => 'checkDuplicate($(this));'],
                            'pluginOptions' => ['allowClear' => true]
                        ])
                        ?>
                    </div>
                    <div class="col-lg-3">
                        <label for="">ต้นทุนต่อหน่วย / Unit Cost</label>
                        <input type="number" class="form-control product-cost" value="0" min="0" onchange="cal_add();">
                    </div>
                    <div class="col-lg-3">
                        <label for="">% ส่วนลด / % Discount</label>
                        <input type="number" class="form-control discount-per" value="0" min="0" onchange="cal_add();">
                    </div>
                    <div class="col-lg-3">
                        <label for="">จำนวน/ Quantity</label>
                        <input type="number" class="form-control quantity" value="0" min="0" onchange="cal_add();">
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-lg-3">
                        <label for="">ราคาขายต่อหน่วย / Unit Price</label>
                        <input type="text" class="form-control unit-price" value="" onchange="cal_add();">
                    </div>
                    <div class="col-lg-3">
                        <label for="">ราคารวมขาย / Total Sale Price</label>
                        <input type="text" class="form-control total-sale-price" value="0" readonly>
                    </div>
                    <div class="col-lg-3">
                        <label for="">สต๊อกสินค้า / Stock</label>
                        <input type="text" class="form-control stock-type" value="">
                    </div>
                    <div class="col-lg-3">
                        <label for="">บริษัทผู้นำเข้า / Distributor</label>
                        <?php
                           echo \kartik\select2\Select2::widget([
                               'name' => 'distributor_id',
                               'data'=> \yii\helpers\ArrayHelper::map(\backend\models\Distributor::find()->where(['status' => 1])->orderBy(['can_new' => SORT_ASC])->all(), 'id', 'name'),
                               'options'=>[
                                   'id'=>'selected-distributor-id',
                                   'placeholder' => '-- เลือกผู้นำเข้าหลัก --',
                                   'onchange'=>'checkcreateNew($(this));'
                               ],
                               'pluginOptions' => ['allowClear' => true],
                           ])
                        ?>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-lg-3">
                        <label for="">หมวดหมู่ต้นทุนสินค้า / Cost Type</label>
                        <input type="text" class="form-control cost-type" value="">
                    </div>
                    <div class="col-lg-3">
                        <label for="">Vat</label>
                        <div class="bnt-group" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input type="radio" class="vat-type" name="vat_type" value="1"> In VAT
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" class="vat-type" name="vat_type" value="2"> Ex. VAT
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" class="vat-type" name="vat_type" value="3" checked> No VAT
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label for="">Withholding Tax</label>
                        <div class="bnt-groupx" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input type="radio" class="withholding-type" name="withholding_type" value="1"> Yes
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" class="withholding-type" name="withholding_type" value="2" checked>
                                No
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="btn btn-primary" style="padding: 10px;margin-top: 20px;"
                             onclick="createproductline()">เพิ่มรายการสินค้าในตารางสรุป / Add To Summary
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-12" style="overflow-x: scroll">
                <table class="table-bordered" id="table-list">
                    <thead>
                    <tr>
                        <th style="width: 5%;text-align: center;padding: 5px;">ลำดับที่</th>
                        <th style="width: 18%">รหัสสินค้า/รายละเอียด</th>
                        <th style="text-align: right;">ต้นทุน/หน่วย</th>
                        <th style="text-align: right;width: 10%">Discount</th>
                        <th style="text-align: right;">Dealer price</th>
                        <th style="text-align: right;width: 10%">VAT7%</th>
                        <th style="text-align: right;">รวมทุน/หน่วย</th>
                        <th style="text-align: right;width: 10%">จำนวน</th>
                        <th style="text-align: right;">รวมทุนทั้งหมด</th>
                        <th style="text-align: right;">ราคาขาย/หน่วย</th>
                        <th style="text-align: right;">รวมราคาเสนอ</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($model->isNewRecord): ?>
                        <tr>
                            <td style="text-align: center;">

                            </td>
                            <td style="padding: 0">
                                <input type="hidden" class="line-product-id" name="line_product_id[]" value>
                                <input type="text" class="form-control line-product-name" name="line_product_name[]"
                                       style="border: none;width: 100%" value="">
                            </td>
                            <td style="padding: 0">
                                <input type="number" class="form-control line-cost-per-unit" name="line_cost_per_unit[]"
                                       style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                       value="" min="0" onchange="linecal($(this))">
                            </td>
                            <td style="padding: 0">
                                <input type="number" class="form-control line-discount" name="line_discount[]"
                                       style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                       value="" min="0" onchange="linecal($(this))">
                            </td>
                            <td style="padding: 0">
                                <input type="number" class="form-control line-dealer-price" name="line_dealer_price[]"
                                       style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                       value="" min="0" readonly>
                            </td>
                            <td style="padding: 0">
                                <input type="number" class="form-control line-vat" name="line_vat[]"
                                       style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                       value="" min="0" readonly>
                            </td>
                            <td style="padding: 0">
                                <input type="number" class="form-control line-total-cost-per-unit"
                                       name="line_total_cost_per_unit[]"
                                       style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                       value="" min="0" readonly>
                            </td>
                            <td style="padding: 0">
                                <input type="number" class="form-control line-qty" name="line_qty[]"
                                       style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                       value="" min="0" onchange="linecalqty($(this))">
                            </td>
                            <td style="padding: 0">
                                <input type="text" class="form-control line-total-cost-all" name="line_total_cost_all[]"
                                       style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                       value="" readonly>
                            </td>
                            <td style="padding: 0">
                                <input type="number" class="form-control line-quote-per-unit"
                                       name="line_quote_per_unit[]"
                                       style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                       value="" min="0" onchange="linecalqty($(this))">
                            </td>
                            <td style="padding: 0">
                                <input type="hidden" class="line-vat-type" name="line_vat_type[]" value="">
                                <input type="hidden" class="line-withholding-type" name="line_withholding_type[]"
                                       value="">
                                <input type="hidden" class="line-distributor-id" name="line_distributor_id[]" value="">
                                <input type="text" class="form-control line-total-quote-price"
                                       name="line_total_quote_price[]"
                                       style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                       value="" readonly>
                            </td>
                            <td style="text-align: center;">
                                <div class="btn btn-sm btn-danger" onclick="removeline($(this))">-</div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $line_no = 0; ?>
                        <?php if ($model_line != null): ?>
                            <?php foreach ($model_line as $value): ?>
                                <?php $line_no += 1; ?>
                                <tr data-var="<?= $value->id ?>">
                                    <td style="text-align: center;">
                                        <?= $line_no; ?>
                                    </td>
                                    <td style="padding: 0">
                                        <input type="hidden" class="line-rec-id" name="rec_id[]"
                                               value="<?= $value->id ?>">
                                        <input type="hidden" class="line-product-id" name="line_product_id[]"
                                               value="<?= $value->product_id ?>">
                                        <input type="text" class="form-control line-product-name"
                                               name="line_product_name[]" style="border: none;width: 100%"
                                               value="<?= $value->product_name ?>">
                                    </td>
                                    <td style="padding: 0">
                                        <input type="number" class="form-control line-cost-per-unit"
                                               name="line_cost_per_unit[]"
                                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                               value="<?= $value->cost_per_unit ?>" min="0" onchange="linecal($(this))">
                                    </td>
                                    <td style="padding: 0">
                                        <input type="number" class="form-control line-discount" name="line_discount[]"
                                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                               value="<?= $value->discount_per ?>" min="0" onchange="linecal($(this))">
                                    </td>
                                    <td style="padding: 0">
                                        <input type="number" class="form-control line-dealer-price"
                                               name="line_dealer_price[]"
                                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                               value="<?= $value->dealer_price ?>" min="0" readonly>
                                    </td>
                                    <td style="padding: 0">
                                        <input type="number" class="form-control line-vat" name="line_vat[]"
                                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                               value="<?= $value->vat_amount ?>" min="0" readonly>
                                    </td>
                                    <td style="padding: 0">
                                        <input type="number" class="form-control line-total-cost-per-unit"
                                               name="line_total_cost_per_unit[]"
                                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                               value="<?= $value->total_cost_per_unit ?>" min="0" readonly>
                                    </td>
                                    <td style="padding: 0">
                                        <input type="number" class="form-control line-qty" name="line_qty[]"
                                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                               value="<?= $value->qty ?>" min="0" onchange="linecalqty($(this))">
                                    </td>
                                    <td style="padding: 0">
                                        <input type="text" class="form-control line-total-cost-all"
                                               name="line_total_cost_all[]"
                                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                               value="<?= $value->cost_total ?>" readonly>
                                    </td>
                                    <td style="padding: 0">
                                        <input type="number" class="form-control line-quote-per-unit"
                                               name="line_quote_per_unit[]"
                                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                               value="<?= $value->quotation_per_unit_price ?>" min="0"
                                               onchange="linecalqty($(this))">
                                    </td>
                                    <td style="padding: 0">
                                        <input type="hidden" class="line-vat-type" name="line_vat_type[]"
                                               value="<?= $value->vat_type ?>">
                                        <input type="hidden" class="line-withholding-type"
                                               name="line_withholding_type[]" value="<?= $value->withholdingtax ?>">
                                        <input type="hidden" class="line-distributor-id" name="line_distributor_id[]" value="<?= $value->distributor_id ?>">
                                        <input type="text" class="form-control line-total-quote-price"
                                               name="line_total_quote_price[]"
                                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                               value="<?= $value->total_quotation_price ?>" readonly>
                                    </td>
                                    <td style="text-align: center;">
                                        <div class="btn btn-sm btn-danger" onclick="removeline($(this))">-</div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td style="text-align: center;">

                                </td>
                                <td style="padding: 0">
                                    <input type="hidden" class="line-rec-id" name="rec_id[]" value="">
                                    <input type="hidden" class="line-product-id" name="line_product_id[]" value>
                                    <input type="text" class="form-control line-product-name" name="line_product_name[]"
                                           style="border: none;width: 100%" value="">
                                </td>
                                <td style="padding: 0">
                                    <input type="number" class="form-control line-cost-per-unit"
                                           name="line_cost_per_unit[]"
                                           style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                           value="" min="0" onchange="linecal($(this))">
                                </td>
                                <td style="padding: 0">
                                    <input type="number" class="form-control line-discount" name="line_discount[]"
                                           style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                           value="" min="0" onchange="linecal($(this))">
                                </td>
                                <td style="padding: 0">
                                    <input type="number" class="form-control line-dealer-price"
                                           name="line_dealer_price[]"
                                           style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                           value="" min="0" readonly>
                                </td>
                                <td style="padding: 0">
                                    <input type="number" class="form-control line-vat" name="line_vat[]"
                                           style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                           value="" min="0" readonly>
                                </td>
                                <td style="padding: 0">
                                    <input type="number" class="form-control line-total-cost-per-unit"
                                           name="line_total_cost_per_unit[]"
                                           style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                           value="" min="0" readonly>
                                </td>
                                <td style="padding: 0">
                                    <input type="number" class="form-control line-qty" name="line_qty[]"
                                           style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                           value="" min="0" onchange="linecalqty($(this))">
                                </td>
                                <td style="padding: 0">
                                    <input type="text" class="form-control line-total-cost-all"
                                           name="line_total_cost_all[]"
                                           style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                           value="" readonly>
                                </td>
                                <td style="padding: 0">
                                    <input type="number" class="form-control line-quote-per-unit"
                                           name="line_quote_per_unit[]"
                                           style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                           value="" min="0" onchange="linecalqty($(this))">
                                </td>
                                <td style="padding: 0">
                                    <input type="hidden" class="line-vat-type" name="line_vat_type[]" value="">
                                    <input type="hidden" class="line-withholding-type" name="line_withholding_type[]"
                                           value="">
                                    <input type="hidden" class="line-distributor-id" name="line_distributor_id[]" value="">
                                    <input type="text" class="form-control line-total-quote-price"
                                           name="line_total_quote_price[]"
                                           style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                           value="" readonly>
                                </td>
                                <td style="text-align: center;">
                                    <div class="btn btn-sm btn-danger" onclick="removeline($(this))">-</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td></td>
                        <td style="text-align: right;">รวมราคา</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="padding: 0">
                            <input type="text" class="form-control sub-total-1"
                                   style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value=""
                                   readonly>
                        </td>
                        <td></td>
                        <td style="padding: 0;">
                            <input type="text" class="form-control sub-total-2"
                                   style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value=""
                                   readonly>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: right;">ส่วนสด</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="padding: 0;">
                            <input type="text" class="form-control discount-all"
                                   style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value=""
                                   readonly>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: right;">จำนวนเงินหลังหักส่วนลด</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="padding: 0;">
                            <input type="text" class="form-control after-discount-all"
                                   style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value=""
                                   readonly>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: right;">ภาษีมูลค่าเพิ่ม 7%</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="padding: 0;">
                            <input type="text" class="form-control vat-all"
                                   style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value=""
                                   readonly>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: right;">จำนวนเงินรวมทั้งสิ้น</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="padding: 0;">
                            <input type="hidden" class="job-value-amount" name="job_value_amount" value="">
                            <input type="text" class="form-control grand-total-all"
                                   style="background-color: black;color: white;border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                   value="" readonly>
                        </td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <br/>
        <div class="form-group">
            <!--            <div class="btn btn-sm btn-primary" onclick="finditem()">เพิ่มรายการ</div>-->
        </div>
        <div class="form-group">
            <?php //echo Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <div class="btn btn-success" onclick="submitForm()">Save</div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <br/>

<?php
$cost_with_vat = 0;
$cost_without_vat = 0;
$total_cost = 0;
$cross_check = 0;


foreach ($product_as_service as $valuex) {
    $cost_with_vat = $cost_with_vat + sumcostvat($model->id, $valuex->id, 1);
    $cost_without_vat = $cost_without_vat + sumcostvat($model->id, $valuex->id, 2);


}
$total_cost = $cost_with_vat + $cost_without_vat;

function sumcostvat($job_id, $deduct_id, $vat_type)
{
    $amount = 0;
    if ($job_id && $deduct_id) {
        if ($vat_type == 1) {
            $model = \common\models\ViewJobData::find()->where(['id' => $job_id, 'cal_type_id' => $deduct_id, 'vat_type' => 1])->sum('cost_total');
            if ($model) {
                $amount = $model;
            }
        } else {
            $model = \common\models\ViewJobData::find()->where(['id' => $job_id, 'cal_type_id' => $deduct_id, 'vat_type' => [2, 3]])->sum('cost_total');
            if ($model) {
                $amount = $model;
            }
        }

    }
    return $amount;
}

?>

    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                    <h5><b>ข้อมูลรายการขายสินค้า / Product Sales Information</b></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="text-align: center;background-color: lightblue"><b>รายการ</b></th>
                            <th style="text-align: right;background-color: lightblue"><b>จำนวนเงิน</b></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="background-color: lightgrey"><b>ต้นทุน(แบบคิดภาษีมูลค่าเพิ่ม 7%)</b></td>
                            <td style="background-color: lightgrey;text-align: right;">
                                <b><?= number_format($cost_with_vat, 2) ?></b></td>
                        </tr>
                        <?php foreach ($product_as_service as $service_value): ?>
                            <tr>
                                <td style="text-indent: 20px;"><?= $service_value->name ?></td>
                                <td style="text-align: right">
                                    <?= number_format(sumcost($model->id, $service_value->id, 1), 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td style="background-color: lightgrey"><b>ต้นทุน(แบบไม่คิดภาษีมูลค่าเพิ่ม 7%)</b></td>
                            <td style="background-color: lightgrey;text-align: right;">
                                <b><?= number_format($cost_without_vat, 2) ?></b></td>
                        </tr>
                        <?php foreach ($product_as_service as $service_value): ?>
                            <tr>
                                <td style="text-indent: 20px;"><?= $service_value->name ?></td>
                                <td style="text-align: right">
                                    <?= number_format(sumcost($model->id, $service_value->id, 2), 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td style="background-color: lightgrey"><b>รวมต้นทุนทั้งหมด</b></td>
                            <td style="background-color: lightgrey;text-align: right;">
                                <b><?= number_format($total_cost, 2) ?></b></td>
                        </tr>
                        <tr>
                            <?php
                            $status_background_color = "red";
                            $status_check_text = "FALSE";
                            $job_cost_all = getJobAllCost($model->id);

                            if ($job_cost_all == $total_cost && $job_cost_all > 0) {
                                $status_background_color = "green";
                                $status_check_text = "TRUE";
                            }
                            ?>
                            <td style="background-color: lightgrey"><b>ตรวจสอบต้นทุนรวมถูกต้อง</b></td>
                            <td style="background-color: <?= $status_background_color ?>;text-align: center;color: white;">
                                <?= $status_check_text ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
        $job_value_amount = $model->job_value_amount;
        ?>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                    <h5><b>ตารางสรุปต้นทุน-กำไร ของงาน / Cost & Profit Summary Table</b></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="text-align: center;background-color: lightblue"><b>รายการ</b></th>
                            <th style="text-align: right;background-color: lightblue"><b>จำนวนเงิน</b></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="background-color: lightgrey"><b>มูลค่ารวมของงาน / Sales Value</b></td>
                            <td style="background-color: lightgrey;text-align: right;">
                                <b><?= number_format($job_value_amount, 2) ?></b></td>
                        </tr>
                        <tr>
                            <td style="text-indent: 20px;">มูลค่างาน (ไม่รวมภาษีมูลค่าเพิ่ม)</td>
                            <td style="text-align: right">
                                <?= number_format(getJobAmountExcludeVat($model->id), 2) ?></td>
                        </tr>
                        <tr>
                            <td style="text-indent: 20px;">ภาษีมูลค่าเพิ่ม 7%</td>
                            <td style="text-align: right">
                                <?= number_format(getJobVat($model->id), 2) ?></td>
                        </tr>
                        <tr>
                            <td style="background-color: lightgrey"><b>ต้นทุน(แบบคิดภาษีมูลค่าเพิ่ม 7%)</b></td>
                            <td style="background-color: lightgrey;text-align: right;">
                                <b><?= number_format($cost_with_vat, 2) ?></b></td>
                        </tr>
                        <tr>
                            <td style="text-indent: 20px;">ภาษีมูลค่าเพิ่ม 7%</td>
                            <td style="text-align: right">
                                <?= number_format($cost_with_vat - ($cost_with_vat / 1.07), 2) ?></td>
                        </tr>
                        <tr>
                            <td style="text-indent: 20px;">ต้องจ่ายเงินภาษีเพิ่ม</td>
                            <td style="text-align: right">
                                <?= number_format(getJobVat($model->id) - ($cost_with_vat - ($cost_with_vat / 1.07)), 2) ?></td>
                        </tr>


                        <tr>
                            <td style="background-color: lightgrey"><b>ต้นทุน(แบบไม่คิดภาษีมูลค่าเพิ่ม 7%)</b></td>
                            <td style="background-color: lightgrey;text-align: right;">
                                <b><?= number_format($cost_without_vat, 2) ?></b></td>
                        </tr>
                        <tr>
                            <td style="background-color: lightgrey"><b>รวมต้นทุนทั้งหมด (รวมภาษีมูลค่าเพิ่ม 7%)</b></td>
                            <td style="background-color: lightgrey;text-align: right;">
                                <b><?= number_format($cost_with_vat + getJobVat($model->id) - ($cost_with_vat - ($cost_with_vat / 1.07)) + $cost_without_vat, 2) ?></b>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: lightgrey"><b>เหลือเงินกำไรหลังหักภาษีมูลค่าเพิ่ม</b></td>
                            <td style="background-color: lightgrey;text-align: right;">
                                <b><?= number_format($job_value_amount - ($cost_with_vat + getJobVat($model->id) - ($cost_with_vat - ($cost_with_vat / 1.07)) + $cost_without_vat), 2) ?></b>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: lightgrey"><b>% กำไร (ก่อนหักค่าคอมมิชชั่น)</b></td>
                            <td style="background-color: lightgrey;text-align: right;">
                                <?php if ($job_value_amount > 0): ?>
                                    <b><?php echo number_format((($job_value_amount - ($cost_with_vat + getJobVat($model->id) - ($cost_with_vat - ($cost_with_vat / 1.07)) + $cost_without_vat)) / $job_value_amount) * 100, 2) ?>
                                        <span> %</span></b>
                                <?php else: ?>
                                    <b>0</b>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: lightgrey"><b>ค่าคอมมิชชั่น 27%</b></td>
                            <td style="background-color: lightgrey;text-align: right;">
                                <b><?= number_format(0.27 * ($job_value_amount - ($cost_with_vat + getJobVat($model->id) - ($cost_with_vat - ($cost_with_vat / 1.07)) + $cost_without_vat)), 2) ?></b>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <h5><b>ข้อมูลการรับเงินค่าสินค้า / Payment Receipt Information</b></h5>
        </div>
    </div>

    <form id="form-job-payment" action="<?= \yii\helpers\Url::to(['job/createpaymentnew'], true) ?>" method="post">
        <input type="hidden" name="job_id" value="<?= $model->id ?>">
        <div class="row" style="background-color: lightblue;padding: 8px;">
            <div class="col-lg-3">
                <label for="">ประเภทชำระเงิน</label>
                <?php
                echo \kartik\select2\Select2::widget([
                    'name' => 'payment_method_id',
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Paymentmethod::find()->where(['status' => 1])->all(), 'id', 'name'),
                    'options' => [
                        'class' => 'form-control payment-method-id',
                        'placeholder' => 'ประเภทชำระเงิน'
                    ],
                ]);
                ?>
            </div>
            <div class="col-lg-3">
                <label for="">วันที่</label>
                <?php
                echo \kartik\date\DatePicker::widget([
                    'name' => 'payment_date',
                    'options' => [
                        'class' => 'form-control payment-date',
                    ]
                    ,
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'autoclose' => true,
                        'todayHighlight' => true
                    ]
                ])
                ?>
            </div>
            <div class="col-lg-3">
                <label for="">จำนวนเงิน</label>
                <input type="number" class="form-control payment-amount" name="payment_amount" value="0"
                       placeholder="จำนวนเงิน" min="-0.00" step="any">
            </div>
            <div class="col-lg-3">
                <label for="">ค่าธรรมเนียมการโอน</label>
                <input type="number" class="form-control fee-amount" name="fee_amount" value="0"
                       placeholder="ค่าธรรมเนียมการโอน" min="0">
            </div>
        </div>
        <div class="row" style="background-color: lightblue;padding: 8px;">
            <div class="col-lg-12" style="text-align: right;">
                <button class="btn btn-primary">เพิ่มรายการรับเงิน</button>
            </div>
        </div>
    </form>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="background-color: lightseagreen;color: white;width: 10%;text-align: center;">
                        ชำระครั้งที่
                    </th>
                    <th style="background-color: lightseagreen;color: white;width: 20%">ประเภทธุรกรรม</th>
                    <th style="background-color: lightseagreen;color: white;width: 20%">วันที่ทำรายการ</th>
                    <th style="background-color: lightseagreen;color: white;text-align: right;">จำนวนเงิน</th>
                    <th style="background-color: lightseagreen;color: white;width: 15%;text-align: right;">
                        ค่าธรรมเนียมการโอน
                    </th>
                    <th style="background-color: lightseagreen;color: white;text-align: right;width: 20%">
                        รวมจำนวนเงินที่ได้รับ
                    </th>
                    <th style="background-color: lightseagreen;color: white;text-align: center;"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $model_payment = \common\models\JobPayment::find()->where(['job_id' => $model->id])->all();
                $total_payment = 0;
                $line_num = 0;
                ?>
                <?php if ($model_payment): ?>
                    <?php foreach ($model_payment as $value): ?>
                        <?php
                        $total_payment += $value->amount;
                        $line_num += 1;
                        ?>
                        <tr data-var="<?= $value->id ?>">
                            <td style="text-align: center;"><?= $line_num ?></td>
                            <td><?= \backend\models\Paymentmethod::findName($value->payment_method_id); ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($value->trans_date)); ?></td>
                            <td style="text-align: right;"><?= number_format($value->amount, 2); ?></td>
                            <td style="text-align: right;"><?= number_format($value->fee_amount, 2); ?></td>
                            <td style="text-align: right;"><?= number_format($value->amount + $value->fee_amount, 2); ?></td>

                            <!--                            <td>-->
                            <?php //= $value->slip_doc!=''?'<a href="'.\Yii::$app->request->baseUrl.'/uploads/slip_doc/'.$value->slip_doc.'" target="_blank">แสดงรูปภาพ</a>':''; ?><!--</td>-->
                            <td style="text-align: center">
                                <div class="btn btn-sm btn-danger" onclick="removepaymentline($(this))">-</div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;color: red">ไม่พบรายการ</td>
                    </tr>
                <?php endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5" style="text-align: right;"><b>รวม</b></td>
                    <td style="text-align: right;background-color: lightgrey">
                        <b><?= number_format($total_payment, 2) ?></b></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>


    <div id="findModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>รายการสินค้า</h3>
                </div>
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">-->
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto;scrollbar-x-position: top">-->

                <div class="modal-body">
                    <input type="hidden" name="line_qc_product" class="line_qc_product" value="">
                    <table class="table table-bordered table-striped table-find-list" width="100%">
                        <thead>
                        <tr>
                            <th style="width:10%;text-align: center">เลือก</th>
                            <th style="width: 10%;text-align: center">รหัส</th>
                            <th style="width: 20%;text-align: center">รายละเอียดสินค้า</th>
                            <th style="width: 15%;text-align: center">ประเภทสินค้า</th>
                            <th style="width: 15%;text-align: center">จำนวนคงเหลือ</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-success btn-emp-selected" data-dismiss="modalx" disabled><i
                                class="fa fa-check"></i> ตกลง
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                    </button>
                </div>
            </div>

        </div>
    </div>
    <div id="copyModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content">
                <form action="<?= \yii\helpers\Url::to(['job/copyjob'], true) ?>" method="post">
                    <div class="modal-header">
                        <h3>สำเนาใบงาน</h3>
                    </div>
                    <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">-->
                    <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto;scrollbar-x-position: top">-->

                    <div class="modal-body">
                        <input type="hidden" class="current-job-id" name="job_id" value="">
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <label for="">ระบุเลขที่ใบเสนอราคา</label>
                                <input type="text" class="form-control copy-quotation-no" name="quotation_no" value=""
                                       required>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <label for="">ระบุเลขที่ใบกำกับภาษี</label>
                                <input type="text" class="form-control copy-invoice-no" name="invoice_no" value=""
                                       required>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-success btn-emp-selected" data-dismiss="modalx"><i
                                    class="fa fa-check"></i> ตกลง
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                    class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div id="createDistributorModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>สร้างข้อมูลผู้นำเข้าหลัก</h3>
                </div>
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">-->
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto;scrollbar-x-position: top">-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">ชื่อ</label>
                            <input type="text" class="form-control new-distributor-name" name="new_distributor_name"
                                   required value="">

                        </div>
                        <div class="col-lg-4">
                            <label for="">รายละเอียด</label>
                            <input type="text" class="form-control" name="new_distributor_description" required
                                   value="">
                        </div>


                    </div>
                    <div style="height: 10px;"></div>

                    <br/>

                </div>
                <div class="modal-footer">
                    <div class="btn btn-outline-success btn-save-unit" onclick="createnewdistributor()"><i
                                class="fa fa-check"></i> บันทึก
                    </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                    </button>
                </div>
            </div>

        </div>
    </div>
<?php
function getJobpayment($id)
{
    $pay_amount = 0;
    if ($id) {
        $model = \common\models\JobPayment::find()->where(['job_id' => $id])->sum('amount');
        if ($model) {
            $pay_amount = $model;
        }
    }
    return $pay_amount;
}

function getWithholdingAmount($id)
{
    $pay_amount = 0;
    if ($id) {
        $model = \common\models\Job::find()->where(['id' => $id])->sum('withholding_amount');
        if ($model) {
            $pay_amount = $model;
        }
    }
    return $pay_amount;
}

function getPaidPending($id)
{
    $pending_amount = 0;
    if ($id) {
        $model = \common\models\JobPayment::find()->where(['job_id' => $id])->sum('amount');
        $model_job_amount = \common\models\Job::find()->where(['id' => $id])->sum('job_value_amount');
        if ($model) {
            $pending_amount = $model_job_amount - $model;
        } else {
            if ($model_job_amount) {
                $pending_amount = $model_job_amount;
            }
        }
    }
    return $pending_amount;
}

function sumcost($job_id, $deduct_id, $type_id)
{
    $amount = 0;
    if ($job_id && $deduct_id) {
        if ($type_id == 1) {
            $model = \common\models\ViewJobData::find()->where(['id' => $job_id, 'cal_type_id' => $deduct_id, 'vat_type' => 1])->sum('cost_total');
            if ($model) {
                $amount = $model;
            }
        } else {
            $model = \common\models\ViewJobData::find()->where(['id' => $job_id, 'cal_type_id' => $deduct_id, 'vat_type' => [2, 3]])->sum('cost_total');
            if ($model) {
                $amount = $model;
            }
        }

    }
    return $amount;
}

function getJobAmountExcludeVat($job_id)
{
    $amount = 0;
    if ($job_id) {
        $model = \common\models\ViewJobData::find()->where(['id' => $job_id])->sum('total_quotation_price');
        if ($model) {
            $amount = $model;
        }
    }
    return $amount;
}

function getJobVat($job_id)
{
    $amount = 0;
    if ($job_id) {
        $model = \common\models\ViewJobData::find()->where(['id' => $job_id])->sum('total_quotation_price');
        if ($model) {
            $amount = ($model * 7) / 100;
        }
    }
    return $amount;
}

function getJobAllCost($job_id)
{
    $amount = 0;
    if ($job_id) {
        $model = \common\models\ViewJobData::find()->where(['id' => $job_id])->sum('cost_total');
        if ($model) {
            $amount = $model;
        }
    }
    return $amount;
}

?>

<?php
$url_to_find_item = \yii\helpers\Url::to(['product/finditem'], true);
$url_to_find_employee = \yii\helpers\Url::to(['job/getemployee'], true);
$url_to_remove_payment_line = \yii\helpers\Url::to(['job/removepaymentline'], true);
$url_to_create_distributor = \yii\helpers\Url::to(['job/createdistributor'], true);
$js = <<<JS
var selecteditem = [];
var removelist = [];
$(function(){
    calTotal();
    
    $('#selected-distributor-id').on('select2:open', function() {
            setTimeout(function() {
                $(".select2-results__option").each(function() {
                    //var id = $(this).attr(""); // Get the option ID
                    
                    // if (id &&id.includes("9")) { // Change background for ID = 1
                    //     $(this).css("background-color", "#28a745"); // Green
                    //     $(this).css("color", "white"); // White text for better contrast
                    // }
                    
                    var text = $(this).text().trim();
                    
                      if (text === 'Create New') { // Change background for ID = 1
                        $(this).css("background-color", "#28a745"); // Green
                        $(this).css("color", "white"); // White text for better contrast
                        $(this).css("text-align","center");
                    }
                });
            }, 100);
    });
});
function checkDuplicate(e){
    $("#table-list tbody tr").each(function(){
        if($(this).closest("tr").find(".line-product-id").val() == e.val()){
            alert('ไม่สามารถเลือกรายการซ้ําได้');
            return;
        }
    });
}
function changeHoldingTax(e){
    if(e.attr("checked")){
        e.prop( "checked", false );
       // alert(1);
    }else{
        e.prop( "checked", true );
      //  alert(0);
    }
   
}
function cal_add(){
    var add_product_cost = $(".product-cost").val();
    var add_quantity = $(".quantity").val();
    var add_discount_per = $(".discount-per").val();
    var add_unit_price = $(".unit-price").val();
    
    var add_total_sale_price = add_product_cost * add_quantity;
    var add_total_discount = add_total_sale_price * add_discount_per / 100;
    var add_total_distributor = add_total_sale_price - add_total_discount;
    
    var add_quot_price = add_quantity * add_unit_price;
   // alert(add_quot_price);
    $(".total-sale-price").val(add_quot_price);
    
}
function createproductline(){
    var add_product_id = $(".product-id").val();
    var add_product_name = $(".product-id option:selected").text();
    var add_product_cost = $(".product-cost").val();
    var add_discount_per = $(".discount-per").val();
    var add_quantity = $(".quantity").val();
    var add_unit_price = $(".unit-price").val();
    var add_total_sale_price = $(".total-sale-price").val();
    var add_total_distributor = $(".distributor").val();
    var add_vat_type = document.querySelector('input[name="vat_type"]:checked').value;
    var add_withholding_type = document.querySelector('input[name="withholding_type"]:checked').value;
    var add_distributor_id = $("#selected-distributor-id").val();
    
  //  alert(add_total_sale_price);
    
    if(add_product_id === ""){
        //alert(add_product_id);
        $("#product-id").focus();
        $("#product-id").addClass("is-invalid");
        return false;
    }
    
    var check_dup = 0;
    
    $("#table-list tbody tr").each(function(){
        if($(this).closest("tr").find(".line-product-id").val() === add_product_id){
           check_dup+=1;
        }
    });
    
    if(check_dup > 0){
         alert('ไม่สามารถเลือกรายการซ้ําได้');
            return false;
    }
    
             var tr = $("#table-list tbody tr:last");
             var line_discount = 0;
             var line_dealer_price = 0;
             var line_vat = 0;
                       
             line_discount = parseFloat(add_product_cost) * parseFloat(add_discount_per) / 100;
             line_dealer_price = parseFloat(add_product_cost) - parseFloat(line_discount);
             //alert(add_vat_type);
             if(add_vat_type === 1){
                 line_vat =  parseFloat(line_dealer_price) * 7 /100;
             }else{
                 line_vat = 0;
                 //alert(add_vat_type);
             }
                   if (tr.closest("tr").find(".line-product-id").val() == "") {
                       
                  //  alert(line_prod_code);
                    tr.closest("tr").find(".line-rec-id").val(0);
                    tr.closest("tr").find(".line-product-id").val(add_product_id);
                    tr.closest("tr").find(".line-product-name").val(add_product_name);
                    tr.closest("tr").find(".line-cost-per-unit").val(add_product_cost);
                    tr.closest("tr").find(".line-discount").val(add_discount_per);
                    tr.closest("tr").find(".line-qty").val(add_quantity);
                    tr.closest("tr").find(".line-unit-price").val(add_unit_price);
                    tr.closest("tr").find(".line-total-cost-per-unit").val(add_total_sale_price);
                    tr.closest("tr").find(".line-quote-per-unit").val(add_unit_price);
                    tr.closest("tr").find(".line-vat-type").val(add_vat_type);
                    tr.closest("tr").find(".line-withholding-type").val(add_withholding_type);
                    tr.closest("tr").find(".line-vat").val(line_vat);
                    tr.closest("tr").find(".line-dealer-price").val(line_dealer_price);
                    tr.closest("tr").find(".line-distributor-id").val(add_distributor_id);
                    
                    linecal(tr);
                    //console.log(line_prod_code);
                    } else {
                     //  alert("close is " + add_total_sale_price);
                        var clone = tr.clone();
                            clone.closest("tr").find(".line-rec-id").val(0);
                            clone.closest("tr").find(".line-product-id").val(add_product_id);
                            clone.closest("tr").find(".line-product-name").val(add_product_name);
                            clone.closest("tr").find(".line-cost-per-unit").val(add_product_cost);
                            clone.closest("tr").find(".line-discount").val(add_discount_per);
                            clone.closest("tr").find(".line-qty").val(add_quantity);
                            clone.closest("tr").find(".line-unit-price").val(add_unit_price);
                            clone.closest("tr").find(".line-total-cost-per-unit").val(add_total_sale_price);
                           // clone.closest("tr").find(".line-total-cost-per-unit").val(0);
                            clone.closest("tr").find(".line-quote-per-unit").val(add_unit_price);
                            clone.closest("tr").find(".line-vat-type").val(add_vat_type);
                            clone.closest("tr").find(".line-withholding-type").val(add_withholding_type);
                            clone.closest("tr").find(".line-vat").val(line_vat);
                            clone.closest("tr").find(".line-dealer-price").val(line_dealer_price);
                            clone.closest("tr").find(".line-distributor-id").val(add_distributor_id);
                        tr.after(clone);
                        linecal(clone);
                    } 
             
         var linenum = 0;    
        $("#table-list tbody tr").each(function () {
           linenum += 1;
            $(this).closest("tr").find("td:eq(0)").text(linenum);
            // $(this).find(':input[type="number"]').val("0");
            // $(this).closest("tr").find(".line-prod-code").val(line_prod_code);
        });
        
        clearInput();
}
function linecal(e){
    var line_cost_per_unit = e.closest('tr').find(".line-cost-per-unit").val();
    var line_discount = e.closest('tr').find(".line-discount").val();
    var line_dealer_price = e.closest('tr').find(".line-dealer-price").val();
    var line_vat_type = e.closest('tr').find(".line-vat-type").val();
    var line_vat = e.closest('tr').find(".line-vat").val();
    var line_total_cost_per_unit = e.closest('tr').find(".line-total-cost-per-unit").val();
    var line_qty = e.closest('tr').find(".line-qty").val();
    var line_total_cost_all = e.closest('tr').find(".line-total-cost-all").val();
    var line_quote_per_unit = e.closest('tr').find(".line-quote-per-unit").val();
    
   //  alert("line call " + line_cost_per_unit);
    
    //var line_total_quote_price = $(".line-total-quote-price").val();
    if(line_cost_per_unit == null || line_cost_per_unit == ""){
        line_cost_per_unit = 0;
    }
    if(line_discount == null || line_discount == ""){
        line_discount = 0;
    }
    if(line_dealer_price == null || line_dealer_price == ""){
        line_dealer_price = 0;
    }
    if(line_vat == null || line_vat == ""){
        line_vat = 0;
    }
    if(line_total_cost_per_unit == null || line_total_cost_per_unit == ""){
        line_total_cost_per_unit = 0;
    }
    if(line_qty == null || line_qty == ""){
        line_qty = 0;
    }
    if(line_total_cost_all == null || line_total_cost_all == ""){
        line_total_cost_all = 0;
    }
    if(line_quote_per_unit == null || line_quote_per_unit == ""){
        line_quote_per_unit = 0;
    }
    var dealer_price = parseFloat(line_cost_per_unit) - (parseFloat(line_cost_per_unit) * parseFloat(line_discount) / 100);
   // var line_vat = 0;
    //alert('xxxx = '+line_vat_type);
    if(line_vat_type ==1){
        line_vat = parseFloat(dealer_price) * 7 /100;
    }
    
    var line_total_cost_per_unit = parseFloat(dealer_price) + parseFloat(line_vat);

   // alert("dealer price = "+ line_vat);
   
    e.closest('tr').find(".line-dealer-price").val(dealer_price);
    e.closest('tr').find(".line-vat").val(line_vat);
    e.closest('tr').find(".line-total-cost-per-unit").val(parseFloat(line_total_cost_per_unit).toFixed(2));
    e.closest('tr').find(".line-total-quote-price").val(0);
    
   linecalqty(e);
}
function linecalqty(e){
    var line_qty = e.closest('tr').find(".line-qty").val();
    var line_total_cost_all = e.closest('tr').find(".line-total-cost-per-unit").val();
    var line_quote_per_unit = e.closest('tr').find(".line-quote-per-unit").val();
    if(line_qty == null || line_qty == ""){
        line_qty = 0;
    }
    if(line_total_cost_all == null || line_total_cost_all == ""){
        line_total_cost_all = 0;
    }
    if(line_quote_per_unit == null || line_quote_per_unit == ""){
        line_quote_per_unit = 0;
    }
    
    
    
    var total_cost = parseFloat(line_total_cost_all) * parseFloat(line_qty);
   // var total_quote_all = parseFloat(total_cost) + parseFloat(line_quote_per_unit);
    var total_quote_all = parseFloat(line_quote_per_unit) * parseFloat(line_qty);
    //alert("show last = "+ total_quote_all);
    
    e.closest("tr").find(".line-total-cost-all").val(total_cost.toFixed(2));
    e.closest("tr").find(".line-total-quote-price").val(total_quote_all.toFixed(2));
    
    calTotal();
}
function calTotal(){
    var sub_total_1 = 0;
    var sub_total_2 = 0;
    var discount = 0;
    var after_discount = 0;
    var vat = 0;
    var all_total = 0;
    var line_discount = 0;
    var after_discount = 0;
    var sum_cost = 0;
    var sum_dealer_price = 0;
    
    $("#table-list tbody tr").each(function(){
        sub_total_1 += parseFloat($(this).find(".line-total-cost-all").val());
        sub_total_2 += parseFloat($(this).find(".line-total-quote-price").val());
        
        sum_cost += parseFloat($(this).find(".line-cost-per-unit").val());
        sum_dealer_price += parseFloat($(this).find(".line-dealer-price").val());
    });
    
    line_discount = parseFloat(sum_cost) - parseFloat(sum_dealer_price);
    after_discount = parseFloat(sub_total_2) - parseFloat(line_discount);
    vat = (parseFloat(after_discount) * 7) /100;
    all_total = parseFloat(after_discount) + parseFloat(vat);
    
    $(".sub-total-1").val(parseFloat(sub_total_1).toFixed(2));
    $(".sub-total-2").val(parseFloat(sub_total_2).toFixed(2));
    
      
    $(".discount-all").val(parseFloat(line_discount).toFixed(2));
    $(".after-discount-all").val(parseFloat(after_discount).toFixed(2));
    $(".vat-all").val(parseFloat(vat).toFixed(2));
    $(".grand-total-all").val(parseFloat(all_total).toFixed(2));
    
    $(".job-value-amount").val(parseFloat(all_total).toFixed(2));
}
function finditem(){
     //   alert(customer_id);
        $.ajax({
          type: 'post',
          dataType: 'html',
          url:'$url_to_find_item',
          async: false,
          data: {},
          success: function(data){
             // alert(data);
              $(".table-find-list tbody").html(data);
              $("#findModal").modal("show");
          },
          error: function(err){
              //alert(err);
              alert('error na ja');
          }
        });
}

function addline(e){
    var tr = $("#table-list tbody tr:last");
    
                    var clone = tr.clone();
                    //clone.find(":text").val("");
                    // clone.find("td:eq(1)").text("");
                   clone.find(".line-text").val("0");
                   clone.find(".line-order-no").val("");
                   clone.find(".line-qty").val("0");
                   clone.find(".line-price").val("0");
                   clone.find(".line-total").val("0");
                   
                    clone.attr("data-var", "");
                    clone.find('.line-rec-id').val("0");
                    clone.find('.line-photo').val("");
                   
                    tr.after(clone);
    
}
function removeline(e) {
       
                if (confirm("ต้องการลบรายการนี้ใช่หรือไม่?")) {
                if (e.parent().parent().attr("data-var") != '') {
                    removelist.push(e.parent().parent().attr("data-var"));
                    $(".remove-list").val(removelist);
                }
                // alert(removelist);
                // alert(e.parent().parent().attr("data-var"));
    
                if ($("#table-list tbody tr").length == 1) {
                    $("#table-list tbody tr").each(function () {
                        $(this).find('td:eq(0)').html('');
                        $(this).find(":text").val("");
                        $(this).find(':input[type="number"]').val("0");
                       // $(this).find(".line-prod-photo").attr('src', '');
                       // $(this).find(".line-is-head").val('0').change();
                        // cal_num();
                    });
                } else {
                    e.parent().parent().remove();
                }
                // cal_linenum();
                // cal_all();
                calTotal();
            }
        
        
}
function cancelline(e) {
       
                if (confirm("ต้องการยกเลิกรายการนี้ใช่หรือไม่?")) {
                if (e.parent().parent().attr("data-var") != '') {
                    removelist.push(e.parent().parent().attr("data-var"));
                    $(".remove-list").val(removelist);
                }
                if(e.hasClass('btn-secondary')){
                    e.removeClass('btn-secondary');
                    e.addClass('btn-success');
                }else{
                    e.addClass('btn-secondary');
                    e.removeClass('btn-success');
                }
            }
        
        
}

function addselecteditem(e) {
        var id = e.attr('data-var');
        var item_id = e.closest('tr').find('.line-find-item-id').val();
      
        ///// add new 
         var item_name = e.closest('tr').find('.line-find-item-name').val();
        ///////
        if (id) {
            if (checkhas(item_id)){
                alert("รหัสสินค้าซ้ำ");
                return false;
            }
            if (e.hasClass('btn-outline-success')) {
                var obj = {};
                obj['item_id'] = id;
                obj['item_name'] = item_name;
                
                selecteditem.push(obj);
                
                e.removeClass('btn-outline-success');
                e.addClass('btn-success');
                disableselectitem();
                console.log(selecteditem);
            } else {
                
                e.removeClass('btn-success');
                e.addClass('btn-outline-success');
                
                disableselectitem();
                console.log(selecteditem);
            }
        }
}

function checkhas(item_id){
    var has = 0;
    $("#table-list tbody tr").each(function () {
       var id = $(this).closest("tr").find(".line-product-id").val();
       if (id == item_id ){
           has = 1;
       }
    });
    return has;
}

function disableselectitem() {
        if (selecteditem.length > 0) {
            $(".btn-emp-selected").prop("disabled", "");
            $(".btn-emp-selected").removeClass('btn-outline-success');
            $(".btn-emp-selected").addClass('btn-success');
        } else {
            $(".btn-emp-selected").prop("disabled", "disabled");
            $(".btn-emp-selected").removeClass('btn-success');
            $(".btn-emp-selected").addClass('btn-outline-success');
        }
}

$(".btn-emp-selected").click(function () {
        var linenum = 0;
      
        if(selecteditem.length >0){
             var tr = $("#table-list tbody tr:last");
             var last_line_photo_id = tr.closest("tr").find(".line-photo").attr("id");
    //alert(last_line_photo_id);
             for(var i=0;i<=selecteditem.length-1;i++){
               //  var new_text = selecteditem[i]['line_work_type_name'] + "\\n" + "Order No."+selecteditem[i]['line_order_no'];
                   if (tr.closest("tr").find(".line-product-id").val() == "") {
                  //  alert(line_prod_code);
                    tr.closest("tr").find(".line-rec-id").val(0);
                    tr.closest("tr").find(".line-product-id").val(selecteditem[i]['item_id']);
                    tr.closest("tr").find(".line-product-name").val(selecteditem[i]['item_name']);
                    
                    //console.log(line_prod_code);
                    } else {
                        var clone = tr.clone();
                        clone.closest("tr").find(".line-rec-id").val('0');
                        clone.closest("tr").find(".line-product-id").val(selecteditem[i]['item_id']);
                        clone.closest("tr").find(".line-product-name").val(selecteditem[i]['item_name']);
                        tr.after(clone);
                    } 
             }
                
          
        }
        
        $("#table-list tbody tr").each(function () {
           linenum += 1;
            $(this).closest("tr").find("td:eq(0)").text(linenum);
             $(this).find(':input[type="number"]').val("0");
            // $(this).closest("tr").find(".line-prod-code").val(line_prod_code);
        });
        
        selecteditem = [];
        selectedorderlineid = [];
        selecteditemgroup = [];

        $("#table-find-list tbody tr").each(function () {
            $(this).closest("tr").find(".btn-line-select").removeClass('btn-success');
            $(this).closest("tr").find(".btn-line-select").addClass('btn-outline-success');
        });
        
        $(".btn-emp-selected").removeClass('btn-success');
        $(".btn-emp-selected").addClass('btn-outline-success');
        $("#findModal").modal('hide'); 
        
        calTotal();
});

function submitForm(){
    var check_data = 0;
    $("#table-list tbody tr").each(function(){
          if($(this).closest("tr").find(".line-product-id").val() == '' || $(this).closest("tr").find(".line-total-quote-price").val() == ''){
            check_data +=1;
          } 
    });
    if(check_data > 0){
         alert('กรุณาเลือกรายละเอียดก่อนทำรายการ');
              return false;
    }else{
        //$("#table-list tbody tr").each(function(){
          //  var photo_selected_file = $(this).closest("tr").find(".line-photo").val();
          // $(this).closest("tr").find(".line-photo-index").val(photo_selected_file); 
        //});
        $("form#form-job").submit();
    }
}

function getemployee(e){
    var id = $(e).val();
    var url = "$url_to_find_employee";
    $.ajax({
        url: url,
        type: 'html',
        data: {id: id},
        success: function (data) {
           if(data != null || data != ""){
               $(".selected-head-id").html(data);
           }
        }
    });
}

function copyJob(id){
    if(id >0){
        $("#copyModal").find(".current-job-id").val(id);
        $("#copyModal").modal('show');
    }
}

function removepaymentline(e){
    var id = e.parent().parent().attr("data-var");
    var job_id = $(".model-id").val();
    if(id > 0 && job_id > 0){
        if(confirm("ต้องการลบรายการนี้ใช่หรือไม่?")){
            $.ajax({
                url: "$url_to_remove_payment_line",
                type: 'post',
                dataType: 'html',
                data: {'id': id,'job_id': job_id},
                success: function(data) {
                   // alert(data);
                    window.location.reload();
                },
                error: function(err){
                    alert(err);
                }
            });
        }
    }
}
function checkcreateNew(e){
    var text = $("#selected-distributor-id option:selected").text().trim();
    //alert(text);
    if (text == 'Create New') { // Change background for ID = 1
        $(e).css("background-color", "#28a745"); // Green
        $(e).css("color", "white"); // White text for better contrast
        
        $("#createDistributorModal").modal("show");
    }
}
function createnewdistributor(){
    var unit_name = $(".new-distributor-name").val();
    var unit_desc = $(".new-distributor-description").val();
   // alert(unit_name);
    if(unit_name == ''){
        $(".new-distributor-name").css(["border-color", "red"]);
        return false;
    }else{
        $.ajax({
            url: '$url_to_create_distributor',
            dataType: 'html',
            method: 'POST',
            data: {
                'name': unit_name,
                'description': unit_desc,
            },
            success: function (data) {
                $("#createDistributorModal").modal("hide");
                // $("#selected-unit-id").append('<option value="'+data+'">'+unit_name+'</option>');
                // $("#selected-unit-id").val(data).change();
                if(data != '' || data != null){
                     $("#selected-distributor-id").html(data);
                }
               
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}

function clearInput(){
    $(".product-id").val(-1).change();
    $(".product-cost").val(0);
    $(".discount-per").val(0);
    $(".quantity").val(0);
    $(".unit-price").val(0);
    $(".total-sale-price").val(0);
    $(".distributor").val();
    $("#selected-distributor-id").val(-1).change();
}

JS;

$this->registerJs($js, static::POS_END);

?>