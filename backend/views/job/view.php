<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Job $model */

$this->title = $model->job_no;
$this->params['breadcrumbs'][] = ['label' => 'ใบงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
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
            <?= Html::a('บันทึกค่าใช้จ่าย', ['updatex', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?= Html::a('บันทึกรับเงิน', ['updatex', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
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
                            return \backend\models\Customer::findCusName($data->customer_id);
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
                    'status',

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
                            <?= $value->cost_per_unit ?>
                        </td>
                        <td style="padding: 3px;text-align: right;">
                            <?= $value->discount_per ?>
                        </td>
                        <td style="padding: 3px;text-align: right;">
                            <?= $value->dealer_price ?>
                        </td>
                        <td style="padding: 3px;text-align: right;">
                            <?= $value->vat_amount ?>
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

            </table>
        </div>
    </div>
    <br/>
    <div class="row">
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
                    <td style="text-align: right;">0</td>
                </tr>
                <tr>
                    <td>มูลค่างานก่อนภาษีมูลค่าเพิ่ม</td>
                    <td style="text-align: right;">0</td>
                </tr>
                <tr>
                    <td>ภาษีมูลค่าเพิ่ม</td>
                    <td style="text-align: right;">0</td>
                </tr>
                <tr>
                    <td style="color: red;">รายจ่าย - คิดภาษีมูลค่าเพิ่ม</td>
                    <td style="text-align: right;color: red;">0</td>
                </tr>
                <tr>
                    <td>ภาษีมูลค่าเพิ่ม</td>
                    <td style="text-align: right;">0</td>
                </tr>
                <tr>
                    <td>ต้องจ่ายภาษีมูลค่าเพิ่ม</td>
                    <td style="text-align: right;">0</td>
                </tr>
                <tr>
                    <td style="color: red;">รายจ่าย - ไม่คิดภาษีมูลค่าเพิ่ม</td>
                    <td style="text-align: right;color: red;">0</td>
                </tr>
                <tr>
                    <td style="background-color: red;color: yellow;">รวมรายจ่ายทั้งหมด (รวมภาษีมูลค่าเพิ่ม)</td>
                    <td style="text-align: right;background-color: red;color: yellow;">0</td>
                </tr>
                <tr>
                    <td>เหลือเงินกำไรหลังหักภาษีมูลค่าเพิ่ม</td>
                    <td style="text-align: right;">0</td>
                </tr>
                <tr>
                    <td>%กำไร (ก่อนหักค่าคอมมิสชั่น)</td>
                    <td style="text-align: right;">0</td>
                </tr>
                <tr>
                    <td style="background-color: #9fb96e">Commission 27%</td>
                    <td style="text-align: right;background-color: #9fb96e">0</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="background-color: red;color: white;width: 60%">สรุปค่าใช้จ่าย (แบบคิด VAT)</th>
                    <th style="background-color: red;color: white;text-align: right;">จำนวนเงิน</th>
                </tr>
                </thead>
            </table>
        </div>
        <div class="col-lg-4">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="background-color: red;color: white;width: 60%">สรุปค่าใช้จ่าย (แบบไม่คิด VAT)</th>
                    <th style="background-color: red;color: white;text-align: right;">จำนวนเงิน</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

</div>
