<?php

use kartik\date\DatePicker;

$display_date = date('d-m-Y');
$find_date = date('Y-m-d');
if ($search_date != null) {
    $find_date = date('Y-m-d', strtotime($search_date));
    $display_date = date('d-m-Y', strtotime($search_date));
}
$model = null;

//$model = \backend\models\Workqueue::find()->where(['date(work_queue_date)' => $find_date,'work_option_type_id'=>[1,2]])->all();
if ($search_cost_type != null) {
    $model = \common\models\QueryCashRecord::find()->where(['date(trans_date)' => $find_date, 'cost_title_id' => $search_cost_type])->all();
} else {
    $model = \common\models\QueryCashRecord::find()->where(['date(trans_date)' => $find_date])->all();
}

?>
    <form action="<?= \yii\helpers\Url::to(['report/reportcashrecord'], true) ?>" method="post">
        <div class="row">
            <div class="col-lg-6">
                <label class="form-label">เลือกวันที่</label>
                <div class="input-group">
                    <?php
                    echo DatePicker::widget([
                        'name' => 'search_date',
                        'type' => DatePicker::TYPE_INPUT,
                        'value' => $display_date,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-mm-yyyy'
                        ]
                    ]);
                    ?>
                    <?php
                    echo \kartik\select2\Select2::widget([
                        'name' => 'search_cost_type',
                        'data' => \yii\helpers\ArrayHelper::map(\common\models\FixcostTitle::find()->where(['status'=>1])->all(), 'id', 'name'),
                        'value' => $search_cost_type,
                        'options' => [
                            'placeholder'=>'---เลือกประเภทค่าใช้จ่าย---'
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ]
                    ]);
                    ?>
                    <button class="btn btn-primary">ค้นหา</button>
                </div>
            </div>
        </div>
    </form>
    <br />
    <div id="print-area">
        <table style="width: 100%;">
            <tr>
                <td style="text-align: center;"><h3><b>รายงานเงินสดย่อย</b></h3></td>
            </tr>
            <tr>
                <td style="text-align: center;"><b>วันที่ <?= date('d/m/Y', strtotime($find_date)); ?></b></td>
            </tr>
        </table>
        <br>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 8%;text-align: center;">ลำดับที่</th>
                <th style="width: 10%;text-align: center;">วันที่</th>
                <th style="width: 10%;text-align: center;">ประเภทผู้รับเงิน</th>
                <th style="width: 10%;text-align: center;">ชื่อ</th>
                <th style="width: 10%;text-align: center;">ทะเบียนหัว</th>
                <th style="width: 10%;text-align: center;">ทะเบียนหาง</th>
                <th style="width: 10%;text-align: center;">ประเภทค่าใช้จ่าย</th>
                <th style="width: 10%;text-align: right;">จำนวนเงิน</th>
                <th style="width: 10%;text-align: center;">หมายเหตุ</th>
            </tr>
            </thead>
            <tbody>
            <?php $line_num = 0;
            $total_amount = 0; ?>
            <?php if ($model): ?>
                <?php foreach ($model as $value): ?>
                    <?php
                    $line_num += 1;
                    $total_amount += ($value->amount);
                    ?>
                    <tr>
                        <td style="width: 8%;text-align: center;"><?= $line_num ?></td>
                        <td style="width: 10%;text-align: center;"><?= date('d/m/Y', strtotime($value->trans_date)) ?></td>
                        <td style="width: 10%;text-align: center;"><?= \backend\helpers\PayForType::getTypeById($value->pay_for_type_id) ?></td>
                        <td style="width: 10%;text-align: center;"><?= $value->pay_for_type_id !=1 ? $value->pay_for: $value->fname.' '.$value->lname ?></td>
                        <td style="width: 10%;text-align: center;"><?= $value->car_plate_no ?></td>
                        <td style="width: 10%;text-align: center;"><?= $value->car_tail_plate_no ?></td>
                        <td style="width: 10%;text-align: center;"><?= $value->name ?></td>
                        <td style="width: 10%;text-align: right;"><?= number_format($value->amount,2) ?></td>
                        <td style="width: 10%;text-align: left;"><?= $value->remark?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="7" style="width: 8%;text-align: right;"><b>รวม</b></td>
                <td style="width: 10%;text-align: right;"><b><?= number_format($total_amount, 3) ?></b></td>
                <td></td>
            </tr>
            </tfoot>

        </table>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="btn btn-warning btn-print" onclick="printContent('print-area')">พิมพ์</div>
        </div>
    </div>
<?php
$js = <<<JS
function printContent(el)
      {
         var restorepage = document.body.innerHTML;
         var printcontent = document.getElementById(el).innerHTML;
         document.body.innerHTML = printcontent;
         window.print();
         document.body.innerHTML = restorepage;
     }
JS;
$this->registerJs($js, static::POS_END);
?>