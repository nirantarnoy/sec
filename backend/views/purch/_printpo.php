<?php

use yii\web\View;

function numtothaistring($num)
{
    $return_str = "";
    $txtnum1 = array('', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า');
    $txtnum2 = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
    $num_arr = str_split($num);
    $count = count($num_arr);
    foreach ($num_arr as $key => $val) {
        // echo $count." ".$val." ".$key."</br>";
        if ($count > 1 && $val == 1 && $key == ($count - 1)) {
            $return_str .= "เอ็ด";
        } else if ($count > 1 && $val == 1 && $key == 2) {
            $return_str .= $txtnum2[$val];
        } else if ($count > 1 && $val == 2 && $key == ($count - 2)) {
            $return_str .= "ยี่" . $txtnum2[$count - $key - 1];
        } else if ($count > 1 && $val == 0) {
        } else {
            $return_str .= $txtnum1[$val] . $txtnum2[$count - $key - 1];
        }
    }
    return $return_str;
}

//function numtothai($num)
//{
//    $return = "";
//    $num = str_replace(",","",$num);
//    $number = explode(".",number_format($num,2));
//    if(sizeof($number)>2){
//        return 'รูปแบบข้อมุลไม่ถูกต้อง';
//        exit;
//    }else if(sizeof($number)==1){
//        $number[1]=0;
//    }
//    $return .= numtothaistring($number[0])."บาท";
//    $stang = intval($number[1]);
//    // return $stang;
//    if($stang > 0)
//        $return.= numtothaistring($stang)."สตางค์";
//    else
//        $return .= "ถ้วน";
//    return $return ;
//}

function numtothai($num)
{
    $return = "";
    $num = str_replace(",", "", $num);
    $number = explode(".", $num);
    if (sizeof($number) > 2) {
        return 'รูปแบบข้อมุลไม่ถูกต้อง';
        exit;
    } else if (sizeof($number) == 1) {
        $number[1] = 0;
    }
    // return $number[0];
    $return .= numtothaistring($number[0]) . "บาท";

    $stang = intval($number[1]);
    // return $stang;
    if ($stang > 0) {
        if (strlen($stang) == 1) {
            $stang = $stang . '0';
        }
        $return .= numtothaistring($stang) . "สตางค์";
    } else {
        $return .= "ถ้วน";
    }
    return $return;
}

?>
<div class="report-view">
    <div class="row">
        <?php
        $model = \backend\models\Purch::find()->where(['id' => $purch_id])->one();
        if ($model) {
            $model_line = \backend\models\Purchline::find()->where(['purch_id' => $purch_id])->all();
        }
        ?>

        <div class="row">
            <div class="col-xs-12 report-f26">
                <div class="row">
                    <div class="col-xs-12"
                         align="center">
                        <label for=""><b><span>ใบสั่งซื้อ</span></b></label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table-header">
        <tr>
            <td width="70%">
                <table class="table-header">
                    <tr>
                        <td>
                            <div class="report-f24">
                                ผู้ขาย <span></span>
                            </div>
                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="report-f24">
                                ที่อยู่
                            </div>
                        </td>
                        <td>

                        </td>
                    </tr>
                </table>
            </td>
            <td width="30%">
                <table class="table-header">
                    <tr>
                        <td>
                            <div class="report-f18">
                                วันที่
                            </div>
                        </td>
                        <td>
                            <div class="report-f18">
                                <?= date('d/m/Y', strtotime($model->purch_date)) ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="report-f18">
                                เลขที่
                            </div>
                        </td>
                        <td>
                            <div class="report-f18">
                                <?= $model->purch_no ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="table-report">

        <tr>
            <td width="10%"
                style="text-align: center">
                <div class="report-f18">
                    <b>ลำดับ</b>
                </div>
            </td>
            <td style="text-align: center"
                width="50%">
                <div class="report-f18">
                    รายการ
                </div>
            </td>
            <td style="text-align: center"
                width="15%">
                <div class="report-f18">
                    จำนวน
                </div>
            </td>
            <td style="text-align: center"
                width="15%">
                <div class="report-f18">
                    ราคา/หน่วย
                </div>
            </td>
            <td style="text-align: right"
                width="15%">
                <div class="report-f18">
                    รวม
                </div>
            </td>
        </tr>
        <?php $total = 0; ?>
        <?php foreach ($model_line as $value): ?>
            <?php $total = $total + ($value->qty * $value->price); ?>
            <tr>
                <td style="text-align: center">
                    <div class="report-f18">
                        1
                    </div>
                </td>
                <td>
                    <div class="report-f18"><?= \backend\models\Product::findName($value->product_id) ?></div>
                </td>
                <td style="text-align: center">
                    <div class="report-f18"><?= number_format($value->qty) ?></div>
                </td>
                <td style="text-align: center">
                    <div class="report-f18"><?= number_format($value->price) ?></div>
                </td>
                <td style="text-align: right">
                    <div class="report-f18"><?= number_format($value->qty * $value->price) ?></div>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php for ($x = 0; $x <= 40 - 1; $x++): ?>
            <tr>
                <td style="text-align: center;border-top: 0;border-bottom: 0 ;height: 16px">
                    <div class="report-f18"></div>
                </td>
                <td style="border-top: 0;border-bottom: 0;border-left: 0">
                    <div class="report-f18"></div>
                </td>
                <td style="text-align: center;border-top: 0;border-bottom: 0;border-left: 0">
                    <div class="report-f18"></div>
                </td>
                <td style="text-align: center;border-top: 0;border-bottom: 0;border-left: 0">
                    <div class="report-f18"></div>
                </td>
                <td style="text-align: right;border-top: 0;border-bottom: 0;border-left: 0">
                    <div class="report-f18"></div>
                </td>
            </tr>
            <?php if ($x == 39): ?>
                <tr>
                    <td colspan="4"
                        style="text-align: right;border-bottom: 0">
                        <div class="report-f18">
                            รวม
                        </div>
                    </td>
                    <td style="text-align: right;border-bottom: 0">
                        <div class="report-f18"><?= number_format($total) ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"
                        style="text-align: right;border-top: 0">
                        <div class="report-f18">
                            VAT
                        </div>
                    </td>
                    <td style="text-align: right;border-top: 0">
                        <div class="report-f18">
                            0
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"
                        style="text-align: center;border-right: 0;">
                        <div class="report-f18">
                            <span>(  <?= numtothai($total) ?>  )</span>
                        </div>
                    </td>
                    <td style="text-align: right;border-left: 0">
                        <div class="report-f18">
                            รวมทั้งสิ้น
                        </div>
                    </td>
                    <td style="text-align: right">
                        <div class="report-f18"><?= number_format($total) ?></div>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endfor; ?>

    </table>
    <div style="height: 100px;"></div>
    <table class="table-header">
        <tr>
            <td style="width: 60%">
                <div class="report-f18">ผู้จัดทำ ..................................................</div>
            </td>
            <td>
                <div class="report-f18">ผู้อนุมัติ ................................................</div>
            </td>
        </tr>
    </table>


</div>

