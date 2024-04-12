<?php
$model = null;
$model_total = 0;
$model_receive_total = 0;
if ($find_cash_record_id != null) {
    $model = \backend\models\Cashrecord::find()->where(['id' => $find_cash_record_id])->one();
    if ($model) {
        $model_total = \common\models\CashRecordLine::find()->where(['car_record_id'=>$find_cash_record_id])->sum('amount');
        $model_receive = \common\models\QueryCashRecordRecieve::find()->where(['ref_no' => trim($model->journal_no)])->all();
        $model_receive_total = \common\models\QueryCashRecordRecieve::find()->where(['ref_no'=>$model->journal_no])->sum('amount');
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <form action="<?= \yii\helpers\Url::to(['cashrecordreport/index'], true) ?>" method="post">
            <div class="row">
                <div class="col-lg-3">
                    <label class="form-label">เลือกเลขที่สำคัญจ่าย</label>
                    <div class="input-group">
                        <?php
                        echo \kartik\select2\Select2::widget([
                            'name' => 'find_cash_record_id',
                            'value' => $find_cash_record_id,
                            'data' => \yii\helpers\ArrayHelper::map(\backend\models\Cashrecord::find()->all(), 'id', function ($data) {
                                return $data->journal_no;
                            }),
                            'options' => [
                                'placeholder' => '-- เลือก --'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ]
                        ])
                        ?>
                        <button class="btn btn-primary">ค้นหา</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<div id="print-area">
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%;">
                <tr>
                    <td></td>
                    <td style="text-align: center;"><h5><b>รายงานแสดงรายละเอียดสำคัญจ่าย</b></h5></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%;border: 1px solid grey;">
                <tr>
                    <td style="border: 1px solid grey;width: 15%;text-align: center;padding: 10px;">เลขที่สำคัญจ่าย</td>
                    <td style="border: 1px solid grey;width: 15%;text-align: center;">วันที่จ่ายเงิน</td>
                    <td style="border: 1px solid grey;width: 15%;text-align: center;">จ่ายให้</td>
                    <td style="border: 1px solid grey;width: 15%;text-align: right;">ยอดเงิน</td>
                    <td style="border: 1px solid grey;width: 15%;text-align: right;">รวมเงินคืน</td>
                    <td style="border: 1px solid grey;width: 15%;text-align: right;">คงค้าง</td>
                </tr>
                <?php if ($model != null): ?>
                    <tr>
                        <td style="border: 1px solid grey;width: 15%;text-align: center;padding: 10px;"><?= $model->journal_no ?></td>
                        <td style="border: 1px solid grey;width: 15%;text-align: center;"><?= date('d/m/Y', strtotime($model->trans_date)) ?></td>
                        <td style="border: 1px solid grey;width: 15%;text-align: center;"><?= \backend\models\Car::findName($model->car_id) ?></td>
                        <td style="border: 1px solid grey;width: 15%;text-align: right;padding: 10px;"><?= number_format($model_total, 2) ?></td>
                        <td style="border: 1px solid grey;width: 15%;text-align: right;"><?= number_format($model_receive_total, 2) ?></td>
                        <td style="border: 1px solid grey;width: 15%;text-align: right;"><?= number_format(($model_total - $model_receive_total), 2) ?></td>
                    </tr>
                    <?php if ($model_receive != null): ?>
                        <tr style="background-color: #1aa67d">
                            <td colspan="6" style="border: 1px solid grey;width: 15%;text-align: left;padding: 10px;">
                                ประวัติการคืน
                            </td>
                        </tr>
                        <?php foreach ($model_receive as $value): ?>
                            <tr style="background-color: #1aa67d">
                                <td style="border: 1px solid grey;width: 15%;text-align: center;padding: 10px;">วันที่
                                </td>
                                <td style="border: 1px solid grey;width: 15%;text-align: center;"><?= date('d/m/Y', strtotime($value->trans_date)) ?></td>
                                <td style="border: 1px solid grey;width: 15%;text-align: center;">เลขที่อ้างอิง</td>
                                <td style="border: 1px solid grey;width: 15%;text-align: right;padding: 10px;"><?= $value->journal_no ?></td>
                                <td style="border: 1px solid grey;width: 15%;text-align: right;">จำนวนเงิน</td>
                                <td style="border: 1px solid grey;width: 15%;text-align: right;"><?= number_format($value->amount, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="btn btn-default btn-print" onclick="printContent('print-area')">พิมพ์</div>
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