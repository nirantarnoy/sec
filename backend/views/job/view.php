<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Job $model */

$this->title = $model->job_no;
$this->params['breadcrumbs'][] = ['label' => 'ใบงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$yesno = [['id' => 0, 'name' => 'NO'], ['id' => 1, 'name' => 'YES']];
$deduct_list = \common\models\DeductTitle::find()->where(['status' => 1])->all();
$model_payment = \common\models\JobPayment::find()->where(['job_id' => $model->id])->all();
$system_commission_rate = \backend\models\Mainconfig::findOne(1)->commission_per;
$system_vat_per = \backend\models\Mainconfig::findOne(1)->job_vat_per;

?>
<input type="hidden" class="model-id" value="<?= $model->id ?>">
<input type="hidden" class="system-com-per" value="<?= $system_commission_rate ?>">
<input type="hidden" class="system-vat-per" value="<?= $system_vat_per ?>">
<div class="job-view">
    <div class="row">
        <div class="col-lg-6">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
        <div class="col-lg-6" style="text-align: right;">
            <?php //echo Html::a('บันทึกค่าใช้จ่าย', ['creatededuct', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <div class="btn btn-info" onclick="creatededuct()">บันทึกค่าใช้จ่าย</div>
            <?php //echo Html::a('บันทึกรับเงิน', ['createpayment', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            <div class="btn btn-success" onclick="createpayment()">บันทึกรับเงิน</div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'job_no',
                    'quotation_ref_no',
                    [
                        'attribute' => 'trans_date',
                        'value' => function ($data) {
                            return date('d-m-Y', strtotime($data->trans_date));
                        }
                    ],
                    [
                        'attribute' => 'customer_id',
                        'value' => function ($data) {
                            return \backend\models\Customer::findCusFullName($data->customer_id);
                        }
                    ],
                ],
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'team_id',
                        'value' => function ($data) {
                            return \backend\models\Team::findName($data->team_id);
                        }
                    ],
                    [
                        'attribute' => 'head_id',
                        'value' => function ($data) {
                            return \backend\models\Employee::findFullName($data->head_id);
                        }
                    ],
                   [
                           'attribute' => 'status',
                       'value'=>function($data){
                          return \backend\helpers\JobStatus::getTypeById($data->status);
                       }
                   ],

                ],
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'created_at',
                        'value' => function ($data) {
                            return date('d-m-Y H:i:s', $data->created_at);
                        }
                    ],
                    [
                        'attribute' => 'created_by',
                        'value' => function ($data) {
                            return \backend\models\User::findName($data->created_by);
                        }
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value' => function ($data) {
                            return date('d-m-Y H:i:s', $data->updated_at);
                        }
                    ],
                    [
                        'attribute' => 'updated_by',
                        'value' => function ($data) {
                            return \backend\models\User::findName($data->updated_by);
                        }
                    ],
                ],
            ]) ?>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <table class="table-bordered" id="table-list" style="width: 100%">
                <thead>
                <tr>
                    <th style="background-color: #0f6674;color: white;width: 5%;text-align: center;padding: 5px;">
                        ลำดับที่
                    </th>
                    <th style="background-color: #0f6674;color: white;width: 18%">รหัสสินค้า/รายละเอียด</th>
                    <th style="background-color: #0f6674;color: white;text-align: right;">ต้นทุน/หน่วย</th>
                    <th style="background-color: #0f6674;color: white;text-align: right;width: 8%">Discount</th>
                    <th style="background-color: #0f6674;color: white;text-align: right;">Dealer price</th>
                    <th style="background-color: #0f6674;color: white;text-align: right;width: 7%">VAT7%</th>
                    <th style="background-color: #0f6674;color: white;text-align: right;width: 10%">รวมทุน/หน่วย</th>
                    <th style="background-color: #0f6674;color: white;text-align: right;width: 8%">จำนวน</th>
                    <th style="background-color: #0f6674;color: white;text-align: right;">รวมทุนทั้งหมด</th>
                    <th style="background-color: #0f6674;color: white;text-align: right;">ราคาเสนอ/หน่วย</th>
                    <th style="background-color: #0f6674;color: white;text-align: right;">รวมราคาเสนอ</th>
                </tr>
                </thead>
                <tbody>
                <?php $line_no = 0; ?>
                <?php foreach ($model_line as $value): ?>
                    <?php $line_no += 1; ?>
                    <tr data-var="<?= $value->id ?>">
                        <td style="text-align: center;">
                            <?= $line_no; ?>
                        </td>
                        <td style="padding: 3px;">
                            <input type="hidden" class="line-rec-id" name="rec_id[]" value="<?= $value->id ?>">
                            <input type="hidden" class="line-product-id" name="line_product_id[]"
                                   value="<?= $value->product_id ?>">
                            <?= \backend\models\Product::findName($value->product_id) ?>
                        </td>
                        <td style="padding: 3px;text-align: right;">
                            <input type="hidden" class="form-control line-cost-per-unit" value="<?= $value->cost_per_unit ?>">
                            <?= $value->cost_per_unit ?>
                        </td>
                        <td style="padding: 3px;text-align: right;">
                            <?= $value->discount_per ?>
                        </td>
                        <td style="padding: 3px;text-align: right;">
                            <input type="hidden" class="form-control line-dealer-price" value="<?= $value->dealer_price ?>">
                            <?= $value->dealer_price ?>
                        </td>
                        <td style="padding: 3px;text-align: right;">
                            <input type="text" class="form-control line-vat" name="line_vat[]"
                                   style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                   value="<?= $value->vat_amount ?>" readonly>
                        </td>
                        <td style="padding: 3px;text-align: right;">
                            <?= $value->total_cost_per_unit ?>
                        </td>
                        <td style="padding: 3px;text-align: right;">
                            <?= $value->qty ?>
                        </td>
                        <td style="padding: 0">
                            <input type="text" class="form-control line-total-cost-all" name="line_total_cost_all[]"
                                   style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                   value="<?= $value->cost_total ?>" readonly>
                        </td>
                        <td style="padding: 3px;text-align: right;">
                            <?= $value->quotation_per_unit_price ?>
                        </td>
                        <td style="padding: 0">
                            <input type="text" class="form-control line-total-quote-price"
                                   name="line_total_quote_price[]"
                                   style="border: none;width: 100%;box-sizing: border-box;text-align: right;"
                                   value="<?= $value->total_quotation_price ?>" readonly>
                        </td>
                    </tr>
                <?php endforeach; ?>
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
                        <input type="text" class="form-control sub-total-1" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
                    </td>
                    <td></td>
                    <td style="padding: 0;">
                        <input type="text" class="form-control sub-total-2" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
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
                        <input type="text" class="form-control discount-all" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
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
                        <input type="text" class="form-control after-discount-all" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: right;">ภาษีมูลค่าเพิ่ม <?= $system_vat_per ?>%</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="padding: 0;">
                        <input type="text" class="form-control vat-all" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
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
                        <input type="text" class="form-control grand-total-all" style="background-color: black;color: white;border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br/>
    <div class="row">

        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-6">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="background-color: red;color: white;width: 60%">สรุปค่าใช้จ่าย (แบบคิด VAT)</th>
                            <th style="background-color: red;color: white;text-align: right;">จำนวนเงิน</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total_deduct_with_vat = 0; $total_deduct_with_vat_amount = 0;?>
                        <?php foreach ($deduct_list as $value): ?>
                            <?php
                            $line_amount = get_deduct_amount_by_title_id($value->id, 1);
                            $total_deduct_with_vat += $line_amount;
                            ?>
                            <tr>
                                <td><?= $value->name; ?></td>
                                <td style="text-align: right;"><?= number_format($line_amount, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php $total_deduct_with_vat_amount = ($total_deduct_with_vat * $system_vat_per) / 100; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td><b>รวม</b></td>
                            <td style="text-align: right;"><b><?= number_format($total_deduct_with_vat, 2) ?></b></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="background-color: red;color: white;width: 60%">สรุปค่าใช้จ่าย (แบบไม่คิด VAT)
                            </th>
                            <th style="background-color: red;color: white;text-align: right;">จำนวนเงิน</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total_deduct_no_vat = 0; ?>
                        <?php foreach ($deduct_list as $value): ?>
                            <?php
                            $line_amount = get_deduct_amount_by_title_id($value->id, 0);
                            $total_deduct_no_vat += $line_amount;
                            ?>
                            <tr>
                                <td><?= $value->name; ?></td>
                                <td style="text-align: right;"><?= number_format($line_amount, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td><b>รวม</b></td>
                            <td style="text-align: right;"><b><?= number_format($total_deduct_no_vat, 2) ?></b></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label for=""><b>ประวัติรับโอนเงิน</b></label>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="background-color: lightseagreen;color: white;width: 20%">วันที่ทำรายการ</th>
                            <th style="background-color: lightseagreen;color: white;">ธนาคาร</th>
                            <th style="background-color: lightseagreen;color: white;width: 15%">หลักฐาน</th>
                            <th style="background-color: lightseagreen;color: white;text-align: right;width: 20%">
                                จำนวนเงิน
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total_payment = 0?>
                        <?php if($model_payment): ?>
                           <?php foreach($model_payment as $value): ?>
                            <?php $total_payment += $value->amount; ?>
                               <tr>
                                   <td><?= date('d-m-Y H:i:s',strtotime($value->trans_date)); ?></td>
                                   <td><?= \backend\models\Bank::findName($value->bank_id); ?></td>
                                   <td><?= $value->slip_doc!=''?'<a href="'.\Yii::$app->request->baseUrl.'/uploads/slip_doc/'.$value->slip_doc.'" target="_blank">แสดงรูปภาพ</a>':''; ?></td>
                                   <td style="text-align: right;"><?= number_format($value->amount, 2); ?></td>
                               </tr>
                               <?php endforeach;?>
                        <?php else:?>
                            <tr>
                                <td colspan="4" style="text-align: center;color: red">ไม่พบรายการ</td>
                            </tr>
                        <?php endif;?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right;"><b>รวม</b></td>
                            <td style="text-align: right;"><b><?=number_format($total_payment,2)?></b></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="background-color: red;color: white;width: 60%">Summary</th>
                    <th style="background-color: red;color: white;text-align: center;">W/VAT</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>มูลค่างานทั้งหมด</td>
                    <td style="text-align: right;padding: 2px;">
                        <input type="text" class="form-control total-amount"
                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;background-color: white;"
                               value="0" readonly>
                    </td>
                </tr>
                <tr>
                    <td>มูลค่างานก่อนภาษีมูลค่าเพิ่ม</td>
                    <td style="text-align: right;padding: 2px;">
                        <input type="text" class="form-control total-amount-before-vat"
                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;background-color: white;"
                               value="0" readonly>
                    </td>
                </tr>
                <tr>
                    <td>ภาษีมูลค่าเพิ่ม</td>
                    <td style="text-align: right;padding: 0;">
                        <input type="text" class="form-control total-vat"
                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;background-color: white;"
                               value="0" readonly>
                    </td>
                </tr>
                <tr>
                    <td style="color: red;">รายจ่าย - คิดภาษีมูลค่าเพิ่ม</td>
                    <td style="text-align: right;padding: 0">
                        <input type="text" class="form-control total-deduct-with-vat-amount-cal"
                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;background-color: white;color:red;"
                               value=" <?=number_format($total_deduct_with_vat,2)?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>ภาษีมูลค่าเพิ่ม</td>
                    <td style="text-align: right;padding: 0">
                        <input type="text" class="form-control total-deduct-with-vat-amount"
                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;background-color: white;"
                               value="<?=number_format($total_deduct_with_vat_amount,2)?>" readonly>
                        </td>
                </tr>
                <tr>
                    <td style="color: red">ต้องจ่ายภาษีมูลค่าเพิ่ม</td>
                    <td style="text-align: right;padding: 0">
                        <input type="text" class="form-control must-pay-vat"
                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;background-color: white;color:red;"
                               value="0" readonly>
                    </td>
                </tr>
                <tr>
                    <td style="color: red;">รายจ่าย - ไม่คิดภาษีมูลค่าเพิ่ม</td>
                    <td style="text-align: right;padding: 0">
                        <input type="text" class="form-control total-deduct-no-vat-amount"
                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;background-color: white;color:red;"
                               value="<?=number_format($total_deduct_no_vat,2)?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: red;color: yellow;">รวมรายจ่ายทั้งหมด (รวมภาษีมูลค่าเพิ่ม)</td>
                    <td style="text-align: right;padding: 2px;background-color: red">
                        <input type="text" class="form-control must-pay-vat-all"
                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;background-color: red;color:yellow;font-weight: bold;"
                               value="0" readonly>
                    </td>
                </tr>
                <tr>
                    <td>เหลือเงินกำไรหลังหักภาษีมูลค่าเพิ่ม</td>
                    <td style="text-align: right;padding: 0">
                        <input type="text" class="form-control total-after-deduct-vat"
                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;background-color: white;"
                               value="0" readonly>
                    </td>
                </tr>
                <tr>
                    <td>%กำไร (ก่อนหักค่าคอมมิสชั่น)</td>
                    <td style="text-align: right;padding: 0">
                        <input type="text" class="form-control total-profit-before-commission"
                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;background-color: white;"
                               value="0" readonly>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #9fb96e">Commission <?= $system_commission_rate ?>%</td>
                    <td style="text-align: right;padding: 2px;background-color: #9fb96e;">
                        <input type="text" class="form-control total-commission"
                               style="border: none;width: 100%;box-sizing: border-box;text-align: right;background-color: #9fb96e;color: black;"
                               value="0" readonly>
                    </td>
                </tr>
                </tbody>

            </table>
        </div>
    </div>

</div>

<div id="findDeductModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3>บันทึกรายการหัก</h3>
            </div>
            <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">-->
            <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto;scrollbar-x-position: top">-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="">รายการหัก</label>
                        <?php
                        echo \kartik\select2\Select2::widget([
                            'name' => 'deduct_title_id',
                            'data' => \yii\helpers\ArrayHelper::map(\backend\models\Deductitem::find()->where(['status' => 1])->all(), 'id', 'name'),
                            'options' => [
                                'class' => 'form-control deduct-title-id',
                                'placeholder' => 'รายการหัก'
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-lg-4">
                        <label for="">จำนวนเงิน</label>
                        <input type="number" class="form-control deduct-amount" name="deduct_amount" value=""
                               placeholder="จำนวนเงิน" min="0">
                    </div>
                    <div class="col-lg-3">
                        <label for="">ค่าใช้จ่ายคิด Vat</label>
                        <select name="is_vat" id="" class="form-control is-vat">
                            <?php for ($i = 0; $i <= count($yesno) - 1; $i++): ?>
                                <option value="<?= $yesno[$i]['id'] ?>"><?= $yesno[$i]['name'] ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                </div>
                <div style="height: 10px;"></div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">หมายเหตุ</label>
                        <textarea name="remark" class="form-control remark" cols="30" rows="2"></textarea>
                    </div>
                    <div class="col-lg-4">
                        <div style="height:35px;"></div>
                        <div class="btn btn-success" onclick="adddeductline()">Add</div>
                    </div>
                </div>
                <div style="height: 10px;"></div>
                <br/>
                <form action="<?= Url::to(['job/creatededuct'], true) ?>" method="post">
                    <input type="hidden" class="current-job-id" name="job_id" value="">
                    <input type="hidden" class="deduct-remove-list" name="deduct_remove_list" value="">
                    <table class="table table-bordered" id="table-deduct-list" style="width: 100%">
                        <thead>
                        <tr>
                            <th style="width: 5%;text-align: center;">#</th>
                            <th style="width: 35%;text-align: left;">หัวข้อค่าใช้จ่าย</th>
                            <th style="width: 10%;text-align: right;">จำนวน</th>
                            <th style="width: 10%;text-align: center;">คิด VAT</th>
                            <th style="width: 20%;text-align: left;">หมายเหตุ</th>
                            <th style="text-align: center;width: 5%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="text-align: center;">
                                <input type="text" style="text-align: center;" class="form-control line-num" value=""
                                       readonly>
                            </td>
                            <td>
                                <input type="hidden" class="line-deduct-title-id" name="line_deduct_title_id[]"
                                       value="">
                                <input type="text" class="form-control line-deduct-title-name"
                                       name="line_deduct_title_name[]" value="">
                            </td>
                            <td>
                                <input type="number" style="text-align: right" class="form-control line-deduct-amount"
                                       name="line_deduct_amount[]"
                                       value="" min="0">
                            </td>
                            <td>
                                <input type="hidden" style="text-align: right" class="form-control line-is-vat"
                                       name="line_is_vat[]"
                                       value="">
                                <input type="text" class="form-control line-is-vat-name" value="" disabled>
                            </td>
                            <td>
                                <input type="text" class="form-control line-deduct-remark" name="line_deduct_remark[]"
                                       value="">
                            </td>
                            <td>
                                <div class="btn btn-sm btn-danger" onclick="removedeductline($(this))">-</div>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2" style="text-align: right"><b>รวม</b></td>
                            <td style="text-align: right;">
                                <input type="text" style="text-align: right;" class="form-control total-deduct-amount"
                                       value="" name="total_deduct_amount" readonly>
                            </td>
                        </tr>
                        </tfoot>
                    </table>

            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-success btn-save-deduct" style="display:none;"><i
                            class="fa fa-check"></i> บันทึก
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                </button>
            </div>
            </form>
        </div>

    </div>
</div>

<div id="findPaymentModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3>บันทึกรายการชำระเงิน</h3>
            </div>
            <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">-->
            <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto;scrollbar-x-position: top">-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
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
                    <div class="col-lg-4">
                        <label for="">ธนาคาร</label>
                        <?php
                        echo \kartik\select2\Select2::widget([
                            'name' => 'bank_id',
                            'data' => \yii\helpers\ArrayHelper::map(\backend\models\Bank::find()->where(['status' => 1])->all(), 'id', 'name'),
                            'options' => [
                                'class' => 'form-control bank-id',
                                'placeholder' => 'ธนาคาร'
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-lg-4">
                        <label for="">จำนวนเงิน</label>
                        <input type="number" class="form-control payment-amount" name="payment_amount" value=""
                               placeholder="จำนวนเงิน" min="0">
                    </div>
                </div>
                <div style="height: 10px;"></div>
                <div class="row">
                    <div class="col-lg-3">
                        <label for="">วันที่</label>
                        <?php
                        echo \kartik\date\DatePicker::widget([
                            'name' => 'payment_date',
                            'options'=>[
                                'class' => 'form-control payment-date',
                            ]
                            ,
                            'pluginOptions' => [
                                'format' => 'dd-mm-yyyy',
                                'autoclose' => true
                            ]
                        ])
                        ?>
                    </div>
                    <div class="col-lg-5">
                        <label for="">หมายเหตุ</label>
                        <textarea name="remark" class="form-control payment-remark" cols="30" rows="2"></textarea>
                    </div>
                    <div class="col-lg-4">
                        <div style="height:35px;"></div>
                        <div class="btn btn-success" onclick="addpaymentline()">Add</div>
                    </div>
                </div>
                <div style="height: 10px;"></div>
                <br/>
                <form action="<?= Url::to(['job/createpayment'], true) ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="current-job-id" name="job_id" value="">
                    <input type="hidden" class="payment-remove-list" name="payment_remove_list" value="">
                    <table class="table table-bordered" id="table-payment-list" style="width: 100%">
                        <thead>
                        <tr>
                            <th style="width: 5%;text-align: center;">#</th>
                            <th style="width: 10%;text-align: center;">วันที่</th>
                            <th style="width: 10%;text-align: center;">ช่องทางชำระ</th>
                            <th style="width: 15%;text-align: center;">ธนาคาร</th>
                            <th style="width: 10%;text-align: center;">จำนวนเงิน</th>
                            <th style="width: 10%;text-align: center;">หลักฐาน</th>
                            <th style="width: 15%;text-align: left;">หมายเหตุ</th>
                            <th style="text-align: center;width: 5%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="text-align: center;">
                                <input type="text" style="text-align: center;" class="form-control line-num" value=""
                                       readonly>
                                <input type="hidden" class="line-rec-id" name="line_rec_id[]" value="0">
                            </td>
                            <td>
                                <input type="text" class="form-control line-payment-date"
                                       name="line_payment_date[]" value="">
                            </td>
                            <td>
                                <input type="hidden" class="line-payment-id" name="line_payment_id[]" value="">
                                <input type="text" class="form-control line-payment-name"
                                       name="line_payment_name[]" value="">
                            </td>
                            <td>
                                <input type="hidden" class="line-bank-id" name="line_bank_id[]" value="">
                                <input type="text" class="form-control line-bank-name"
                                       name="line_bank_name[]" value="">
                            </td>
                            <td>
                                <input type="number" style="text-align: right" class="form-control line-payment-amount"
                                       name="line_payment_amount[]"
                                       value="" min="0" onchange="caltotalpayment()">
                            </td>
                            <td>
                                <input type="file" class="form-control line-slip-doc" name="line_slip_doc[]">
                            </td>
                            <td>
                                <input type="text" class="form-control line-payment-remark" name="line_payment_remark[]"
                                       value="">
                            </td>
                            <td>
                                <div class="btn btn-sm btn-danger" onclick="removepaymentline($(this))">-</div>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4" style="text-align: right"><b>รวม</b></td>
                            <td style="text-align: right;">
                                <input type="text" style="text-align: right;" class="form-control total-payment-amount"
                                       value="" name="total_payment_amount" readonly>
                            </td>
                        </tr>
                        </tfoot>
                    </table>

            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-success btn-save-payment" style="display:none;"><i
                            class="fa fa-check"></i> บันทึก
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                </button>
            </div>
            </form>
        </div>

    </div>
</div>

<?php
function get_deduct_amount_by_title_id($title_id, $vat_type)
{
    $deduct_amount = 0;
    $deduct = \common\models\JobDeduct::findOne(['deduct_title_id' => $title_id, 'is_vat' => $vat_type]);
    if (!empty($deduct)) {
        $deduct_amount = $deduct->amount;
    }
    return $deduct_amount;
}

?>

<?php
$url_to_show_deduct = Url::to(['job/show-deduct', true]);
$url_to_show_payment = Url::to(['job/show-payment', true]);
$js = <<<JS
var deduct_remove_list = [];
$(function(){
   
    calTotalTopTable();
    caltotaldeduct();
    caltotal();
    caltotalpayment();
});
function caltotal(){
     var total_before_vat = 0;
     var total = 0;
     var vat_amount = 0;
     var total_com = 0;
     var total_deduct_vat_amt = 0;
     var must_pay_vat = 0;
     var must_pay_vat_all = 0;
     var total_deduct_vat_amt_cal = 0;
     var total_deduct_no_vat_amount = 0;
     var total_deduct_after_deduct_vat = 0;
     var total_profit_before_commission = 0;
     var system_com_per = 0;
     
    total_before_vat = $(".sub-total-2").val().replace(',','');
    total = $(".grand-total-all").val().replace(',','');
    vat_amount = $(".vat-all").val().replace(',','');
    total_deduct_vat_amt = $(".total-deduct-with-vat-amount").val().replace(',','');
    
    system_com_per = $(".system-com-per").val().replace(',','');
    
    must_pay_vat = (parseFloat(vat_amount) - parseFloat(total_deduct_vat_amt));
    total_deduct_vat_amt_cal =  $(".total-deduct-with-vat-amount-cal").val().replace(',','');
    total_deduct_no_vat_amount = $(".total-deduct-no-vat-amount").val().replace(',','');
    
    must_pay_vat_all = (parseFloat(must_pay_vat) + parseFloat(total_deduct_vat_amt_cal) + parseFloat(total_deduct_no_vat_amount));
    
    total_com = (parseFloat(total) * parseFloat(system_com_per)) / 100;
    
    total_deduct_after_deduct_vat = (parseFloat(total) - parseFloat(must_pay_vat_all));
    total_profit_before_commission = (parseFloat(total_deduct_after_deduct_vat) * 100) / parseFloat(total);
    
     $(".total-amount").val(parseFloat(total).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
     $(".total-amount-before-vat").val(parseFloat(total_before_vat).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
     $(".total-vat").val(parseFloat(vat_amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
     $(".total-commission").val(parseFloat(total_com).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
     $(".must-pay-vat").val(parseFloat(must_pay_vat).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
     $(".must-pay-vat-all").val(parseFloat(must_pay_vat_all).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
     $(".total-after-deduct-vat").val(parseFloat(total_deduct_after_deduct_vat).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
     $(".total-profit-before-commission").val(parseFloat(total_profit_before_commission).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
     
}

function calTotalTopTable(){
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
        sub_total_1 += parseFloat($(this).find(".line-total-cost-all").val().replace(',',''));
        sub_total_2 += parseFloat($(this).find(".line-total-quote-price").val().replace(',',''));
        
        sum_cost += parseFloat($(this).find(".line-cost-per-unit").val().replace(',',''));
        sum_dealer_price += parseFloat($(this).find(".line-dealer-price").val().replace(',',''));
    });
    
    line_discount = parseFloat(sum_cost) - parseFloat(sum_dealer_price);
    after_discount = parseFloat(sub_total_2) - parseFloat(line_discount);
    vat = (parseFloat(after_discount) * 7) /100;
    all_total = parseFloat(after_discount) + parseFloat(vat);
    
    $(".sub-total-1").val(parseFloat(sub_total_1).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    $(".sub-total-2").val(parseFloat(sub_total_2).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    
      
    $(".discount-all").val(parseFloat(line_discount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    $(".after-discount-all").val(parseFloat(after_discount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    $(".vat-all").val(parseFloat(vat).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    $(".grand-total-all").val(parseFloat(all_total).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
}
function creatededuct(){
    var c_id = $(".model-id").val();
    if(c_id > 0){
         $.ajax({
              type: 'post',
              dataType: 'html',
              async: false,
              url: '$url_to_show_deduct',
              data: {'id':c_id},
              success: function(data) {
                  $(".current-job-id").val(c_id);
                  $("#table-deduct-list tbody").html(data);
                  $("#findDeductModal").modal('show');
                  caltotaldeduct();
              },
              error: function(err){
                  console.log(err);
              }
         });
    }
   
}
function closeModal(){
   $("#findDeductModal").modal('hide');
}

function adddeductline(){
    var deduct_title_id = $(".deduct-title-id").val();
    var deduct_amount = $(".deduct-amount").val();
    var remark = $(".remark").val();
    var deduct_title_name = $(".deduct-title-id option:selected").text();
    
    var tr = $("#table-deduct-list tbody tr:last");
    if(tr.find(".line-deduct-title-id").val()== null || tr.find(".line-deduct-title-id").val() == ""){
        tr.find(".line-deduct-title-id").val(deduct_title_id);
        tr.find(".line-deduct-title-name").val(deduct_title_name);
        tr.find(".line-deduct-amount").val(deduct_amount);
        tr.find(".line-deduct-remark").val(remark);
        tr.find(".line-is-vat").val($(".is-vat").val());
        tr.find(".line-is-vat-name").val($(".is-vat option:selected").text());
    }else{
        var clone = tr.clone();
        clone.find(".line-deduct-title-id").val(deduct_title_id);
        clone.find(".line-deduct-title-name").val(deduct_title_name);
        clone.find(".line-deduct-amount").val(deduct_amount);
        clone.find(".line-deduct-remark").val(remark);
        clone.find(".line-is-vat").val($(".is-vat").val());
        clone.find(".line-is-vat-name").val($(".is-vat option:selected").text());
        
        clone.find(".btn-remove-deduct").removeClass("disabled");
        clone.find(".btn-remove-deduct").show();
    
        tr.after(clone);
    }
    
    caltotaldeduct();
   
   // $("#findDeductModal").modal('hide');
}

function caltotaldeduct(){
    var total = 0;
    $("#table-deduct-list tbody tr").each(function(){
        var line_total = $(this).find(".line-deduct-amount").val().replace(',','');
        total += parseFloat(line_total);
    });
    $(".total-deduct-amount").val(total);
    calLineNum();
    if(total > 0){
        $(".btn-save-deduct").show();
    }else{
        $(".btn-save-deduct").hide();
    }
}

function removedeductline(e){
    if (confirm("ต้องการลบรายการนี้ใช่หรือไม่?")) {
        deduct_remove_list.push(e.parent().parent().attr("data-var"));
        $(".deduct-remove-list").val(deduct_remove_list);
        e.parent().parent().remove();
    }
    caltotaldeduct();
}
function calLineNum(){
    var num = 0;
    $("#table-deduct-list tbody tr").each(function() {
        num++;
        $(this).find(".line-num").val(num);
    });
    
}


//// ceate payment 

function createpayment(){
    var c_id = $(".model-id").val();
    if(c_id > 0){
         $.ajax({
              type: 'post',
              dataType: 'html',
              async: false,
              url: '$url_to_show_payment',
              data: {'id':c_id},
              success: function(data) {
                  $(".current-job-id").val(c_id);
                  $("#table-payment-list tbody").html(data);
                  $("#findPaymentModal").modal('show');
                  caltotalpayment();
              },
              error: function(err){
                  console.log(err);
              }
         });
    }
   
}

function addpaymentline(){
    var payment_method_id = $(".payment-method-id").val();
    var payment_amount = $(".payment-amount").val();
    var remark = $(".payment-remark").val();
    var payment_method_name = $(".payment-method-id option:selected").text();
    var payment_date = $(".payment-date").val();
    var bank_id = $(".bank-id").val();
    var bank_name = $(".bank-id option:selected").text();
    
    var tr = $("#table-payment-list tbody tr:last");
    if(tr.find(".line-payment-id").val()== null || tr.find(".line-payment-id").val() == ""){
        tr.find(".line-payment-id").val(payment_method_id);
        tr.find(".line-payment-name").val(payment_method_name);
        tr.find(".line-payment-amount").val(payment_amount);
        tr.find(".line-payment-remark").val(remark);
        tr.find(".line-payment-date").val(payment_date);
        tr.find(".line-bank-id").val(bank_id);
        tr.find(".line-bank-name").val(bank_name);
    }else{
        var clone = tr.clone();
        clone.find(".line-payment-id").val(payment_method_id);
        clone.find(".line-payment-name").val(payment_method_name);
        clone.find(".line-payment-amount").val(payment_amount);
        clone.find(".line-payment-remark").val(remark);
        clone.find(".line-payment-date").val($(".payment-date").val());
        clone.find(".line-bank-id").val(bank_id);
        clone.find(".line-bank-name").val(bank_name);
    
        tr.after(clone);
    }
    
    caltotalpayment();
   
   // $("#findDeductModal").modal('hide');
}
function caltotalpayment(){
    var total = 0;
    $("#table-payment-list tbody tr").each(function(){
        var line_total = $(this).find(".line-payment-amount").val();
        total += parseFloat(line_total);
    });
    $(".total-payment-amount").val(total);
    calPaymentLineNum();
    if(total > 0){
        $(".btn-save-payment").show();
    }else{
        $(".btn-save-payment").hide();
    }
}
function removepaymentline(e){
    if (confirm("ต้องการลบรายการนี้ใช่หรือไม่?")) {
        deduct_remove_list.push(e.parent().parent().attr("data-var"));
        $(".payment-remove-list").val(deduct_remove_list);
        e.parent().parent().remove();
    }
    caltotalpayment();
}
function calPaymentLineNum(){
    var num = 0;
    $("#table-payment-list tbody tr").each(function() {
        num++;
        $(this).find(".line-num").val(num);
    });
    
}

JS;
$this->registerJs($js, static::POS_END);
?>

