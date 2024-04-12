<?php


$date_day = date('d', strtotime($model->trans_date));
$date_month = \backend\helpers\Thaimonth::getTypeById((int)(date('m', strtotime($model->trans_date))));
$date_year = date('Y', strtotime($model->trans_date)) + 543;
?>
<style>
    /*body {*/
    /*    font-family: sarabun;*/
    /*    !*font-family: garuda;*!*/
    /*    font-size: 18px;*/
    /*    width: 350px;*/
    /*}*/

    /*table.table-header {*/
    /*    border: 0px;*/
    /*    border-spacing: 1px;*/
    /*}*/

    /*table.table-qrcode {*/
    /*    border: 0px;*/
    /*    border-spacing: 1px;*/
    /*}*/

    /*table.table-qrcode td, th {*/
    /*    border: 0px solid #dddddd;*/
    /*    text-align: left;*/
    /*    padding-top: 2px;*/
    /*    padding-bottom: 2px;*/
    /*}*/

    /*table.table-footer {*/
    /*    border: 0px;*/
    /*    border-spacing: 0px;*/
    /*}*/

    /*table.table-header td, th {*/
    /*    border: 0px solid #dddddd;*/
    /*    text-align: left;*/
    /*    padding-top: 2px;*/
    /*    padding-bottom: 2px;*/
    /*}*/

    /*table.table-title {*/
    /*    border: 0px;*/
    /*    border-spacing: 0px;*/
    /*}*/

    /*table.table-title td, th {*/
    /*    border: 0px solid #dddddd;*/
    /*    text-align: left;*/
    /*    padding-top: 2px;*/
    /*    padding-bottom: 2px;*/
    /*}*/

    /*table {*/
    /*    border-collapse: collapse;*/
    /*    width: 100%;*/
    /*}*/

    /*td, th {*/
    /*    border: 1px solid #dddddd;*/
    /*    text-align: left;*/
    /*    padding: 8px;*/
    /*}*/

    /*tr:nth-child(even) {*/
    /*    !*background-color: #dddddd;*!*/
    /*}*/

    /*table.table-detail {*/
    /*    border-collapse: collapse;*/
    /*    width: 100%;*/
    /*}*/

    /*table.table-detail td, th {*/
    /*    border: 1px solid #dddddd;*/
    /*    text-align: left;*/
    /*    padding: 2px;*/
    /*}*/

    @media print {
        @page {
            size: auto;
        }
    }

    /*@media print {*/
    /*    html, body {*/
    /*        width: 80mm;*/
    /*        height:100%;*/
    /*        position:absolute;*/
    /*    }*/
    /*}*/

</style>
<div class="row">
    <div class="col-lg-12">
        <div class="btn btn-default btn-print" onclick="printContent('print-area')">พิมพ์</div>
    </div>
</div>
<div id="print-area">
    <table style="width: 100%">
        <tr>
            <td style="text-align: right;width: 33%"></td>
            <td style="text-align: center;width: 33%"><h4>
                    <b><?= \backend\models\Company::findCompanyName($model->company_id) ?></b></h4></td>
            <td style="text-align: right;width: 33%"></td>
        </tr>
        <tr>
            <td style="text-align: right;width: 33%"></td>
            <td style="text-align: center;width: 33%">
                <h6><?= \backend\models\Company::findAddress($model->company_id) ?></h6></td>
            <td style="text-align: right;width: 33%"></td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td style="padding: 5px;width: 33%"></td>
            <td style="text-align: center;width: 33%"><h5><b><u>ใบสำคัญรับ</u></b></h5></td>
            <td style="text-align: right;width: 33%">เลขที่ <b><?= $model->journal_no ?></b></td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td style="width:50%;padding: 5px;">อ้างถึง
                <b><?= $model->emp_id != null ? \backend\models\Employee::findFullName($model->emp_id) : \backend\models\Cashrecord::findPayname($model->trans_ref_id) ?></b>
            </td>
            <!--            <td><input type="text" class="form-control"></td>-->
            <td style="width:50%;padding: 5px;"> วันที่ <b><?= date('d-m-Y', strtotime($model->trans_date)) ?></b></td>
            <!--            <td><input type="text" class="form-control"></td>-->
        </tr>
    </table>

    <br>
    <table style="width: 100%;border: 1px solid grey;">
        <tr>
            <td rowspan="2" style="width: 50%;border: 1px solid grey;text-align: center;padding: 5px;"><b>ชื่อบัญชี</b>
            </td>
            <td rowspan="2" style="width: 20%;border: 1px solid grey;text-align: center;padding: 5px;"><b>รหัสบัญชีแยกประเภท</b>
            </td>
            <td colspan="2" style="width: 30%;border: 1px solid grey;text-align: center;padding: 5px;"><b>จำนวนเงิน</b>
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid grey;text-align: right;padding: 5px;"><b>เดบิต</b></td>
            <td style="border: 1px solid grey;text-align: right;padding: 5px;"><b>เครดิต</b></td>
        </tr>
        <?php if ($model_line != null): ?>
            <?php
            $line_diff = 5 - count($model_line);
            $all_total = 0;
            ?>
            <?php foreach ($model_line as $value): ?>
                <?php $all_total = ($all_total + $value->amount); ?>
                <tr>
                    <td style="border: 1px solid grey;text-align: left;padding: 6px;"><?= \backend\models\CostTitle::findName($value->receipt_title_id) ?></td>
                    <td style="border: 1px solid grey;text-align: right;padding: 5px;"></td>
                    <td style="border: 1px solid grey;text-align: right;padding: 5px;"><?= number_format($value->amount, 2) ?></td>
                    <td style="border: 1px solid grey;text-align: right;padding: 5px;"></td>
                </tr>
            <?php endforeach; ?>
            <?php if ($line_diff > 0): ?>
                <?php for ($x = 0; $x <= $line_diff - 1; $x++): ?>
                    <tr>
                        <td style=";border: 1px solid grey;text-align: left;padding: 6px;color: transparent;"><?= $x ?></td>
                        <td style=";border: 1px solid grey;text-align: right;padding: 5px;"></td>
                        <td style=";border: 1px solid grey;text-align: right;padding: 5px;">
                            <b><?= $x == ($line_diff - 1) ? number_format($all_total, 2) : '' ?></b></td>
                        <td style=";border: 1px solid grey;text-align: right;padding: 5px;">
                            <b></b></td>
                    </tr>
                <?php endfor; ?>
            <?php endif; ?>
        <?php else: ?>
            <tr>
                <td style="width: 30%;border: 1px solid grey;text-align: left;padding: 5px;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: right;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: right;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: right;"></td>
            </tr>
            <tr>
                <td style="width: 30%;border: 1px solid grey;text-align: left;padding: 5px;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: right;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: right;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: right;"></td>
            </tr>
            <tr>
                <td style="width: 30%;border: 1px solid grey;text-align: left;padding: 5px;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: right;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: left;padding: 5px;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: right;"></td>
            </tr>
            <tr>
                <td style="width: 30%;border: 1px solid grey;text-align: left;padding: 5px;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: right;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: left;padding: 5px;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: right;"></td>
            </tr>
            <tr>
                <td style="width: 30%;border: 1px solid grey;text-align: left;padding: 5px;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: right;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: left;padding: 5px;"></td>
                <td style="width: 30%;border: 1px solid grey;text-align: right;"></td>
            </tr>

        <?php endif; ?>

    </table>
    <br>
    <table>
        <tr>
            <td style="padding: 10px;">หมายเหตุ</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

    </table>
    <table style="width: 100%;border: 1px solid grey;">
        <tr>
            <td rowspan="2" style="width: 25%;border: 1px solid grey;text-align: center;padding: 5px;"><b>ผู้จัดทำ</b>
            </td>
            <td rowspan="2" style="width: 25%;border: 1px solid grey;text-align: center;padding: 5px;"><b>ผู้ตรวจสอบและอนุมัติ</b>
            </td>
            </td>
            <td colspan="2" style="width: 50%;border: 1px solid grey;text-align: center;padding: 5px;"><b>ผู้ผ่านรายการ</b>
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid grey;text-align: center;padding: 5px;"><b>สมุดรายวันรับคืน</b></td>
            <td style="border: 1px solid grey;text-align: center;padding: 5px;"><b>บัญชีแยกประเภทย่อย</b></td>
        </tr>
        <tr>
            <td style="width: 25%;border: 1px solid grey;text-align: center;padding: 25px 20px 5px 20px;">__________________________________
            </td>
            <td style="width: 25%;border: 1px solid grey;text-align: center;padding: 25px 20px 5px 20px;">__________________________________
            </td>
            </td>
            <td style="width: 25%;border: 1px solid grey;text-align: center;padding: 25px 20px 5px 20px;">__________________________________
            </td>
            <td style="width: 25%;border: 1px solid grey;text-align: center;padding: 25px 20px 5px 20px;">__________________________________
            </td>
        </tr>
        <tr>
            <td style="width: 25%;border: 1px solid grey;text-align: center;padding: 25px 20px 5px 20px;">_________/____________/_____________
            </td>
            <td style="width: 25%;border: 1px solid grey;text-align: center;padding: 25px 20px 5px 20px;">_________/____________/_____________
            </td>
            </td>
            <td style="width: 25%;border: 1px solid grey;text-align: center;padding: 25px 20px 5px 20px;">_________/____________/_____________
            </td>
            <td style="width: 25%;border: 1px solid grey;text-align: center;padding: 25px 20px 5px 20px;">_________/____________/_____________
            </td>
        </tr>
    </table>

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
