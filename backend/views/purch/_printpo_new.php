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
    <div id="print-area">
        <div class="report-view">
            <?php
            $model = \backend\models\Purch::find()->where(['id' => $purch_id])->one();
            if ($model) {
                $model_line = \backend\models\Purchline::find()->where(['purch_id' => $purch_id])->all();
            }
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 100%;text-align: center;">
                                <table style="width: 100%">
                                    <tr>
                                        <td><b>บริษัท เอ็ม-เอ็ม-ซี แมตทีเรียล จำกัด</b></td>
                                    </tr>
                                    <tr>
                                        <td>61/12 หมู่ 6 ถนนตลิ่งชัน-สุพรรบุรี</td>
                                    </tr>
                                    <tr>
                                        <td>ต.บางแม่นาง อ.บางใหญ่ จ.นนทบุรี 11140</td>
                                    </tr>
                                    <tr>
                                        <td><b>โทร</b>: 0-2157-2949 /<b>แฟกซ์</b>: 0-2157-2950</td>
                                    </tr>
                                    <tr>
                                        <td><b>เลขประจำตัวผู้เสียภาษี</b> <span> 0125547011486 (สำนักงานใหญ่)</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                    </table>
                </div>
            </div>
            <br/>
            <table style="width: 100%">
                <tr>
                    <td width="70%" style="text-align: center;">
                        <h4>ใบสั่งซื้อ</h4>
                    </td>
                    <td width="30%">
                        <table style="width: 100%;">
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

            <br/>
            <div class="row">
                <div class="col-lg-12">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 70%;padding: 5px;">
                                <table style="width: 100%;border: 1px;">
                                    <tr>
                                        <td style="border: 1px solid grey;border-bottom: none;padding: 5px;"><b>ชื่อผู้ขาย
                                                :</b><span> <?= \backend\models\Vendor::findName($model->vendor_id); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid grey;border-bottom: none;border-top: none;padding: 5px;">
                                            <b>สาขา :</b><span> <?= \backend\models\Vendor::findVendorlocation($model->vendor_id); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid grey;border-bottom: none;border-top: none;padding: 5px;">
                                            <b>ผู้ติดต่อ:</b><span> <?=\backend\models\Vendor::findContactName($model->vendor_id);?></span></td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid grey;border-bottom: none;border-top: none;padding: 5px;">
                                            <b>ที่อยู่:</b><span> <?= \backend\models\AddressInfo::findVendorAddress($model->vendor_id,1); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid grey;border-top: none;padding: 5px;">
                                            <b>โทร:</b><span> <?= \backend\models\Vendor::findVendorPhone($model->vendor_id); ?></span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 30%;padding: 5px;vertical-align: top;">
                                <table style="width: 100%;border: 1px;">
                                    <tr>
                                        <td style="border: 1px solid grey;border-bottom: none;padding: 5px;"><b>กำหนดส่ง
                                                :</b><span> -</span></td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid grey;border-bottom: none;border-top: none;padding: 5px;">
                                            <b>จำนวนวันเครดิต
                                                :</b><span> <?= \backend\models\Vendor::findPayTermName($model->vendor_id); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid grey;border-bottom: none;border-top: none;padding: 5px;">
                                            <b>เงื่อนไขการชำระเงิน
                                                :</b><span> <?= \backend\models\Vendor::findPayMethodName($model->vendor_id); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid grey;border-bottom: none;border-top: none;padding: 5px;">
                                            <span style="color: transparent;">x</span></td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid grey;border-top: none;padding: 5px;"><span
                                                    style="color: transparent;">x</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-12">
                    <table style="width: 100%">

                        <tr>
                            <td width="10%"
                                style="text-align: center;border: 1px solid grey;padding: 5px;">
                                <div class="report-f18">
                                    <b>ลำดับ</b>
                                </div>
                            </td>
                            <td style="text-align: center;border: 1px solid grey;"
                                width="50%">
                                <div class="report-f18">
                                    <b>รายการ</b>
                                </div>
                            </td>
                            <td style="text-align: center;border: 1px solid grey;"
                                width="15%">
                                <div class="report-f18">
                                    <b>จำนวน</b>
                                </div>
                            </td>
                            <td style="text-align: center;border: 1px solid grey;"
                                width="15%">
                                <div class="report-f18">
                                    <b>ราคา/หน่วย</b>
                                </div>
                            </td>
                            <td style="text-align: right;border: 1px solid grey;padding: 8px;"
                                width="15%">
                                <div class="report-f18">
                                    <b>รวม</b>
                                </div>
                            </td>
                        </tr>
                        <?php $total = 0;
                        $row_nums = 0; ?>
                        <?php foreach ($model_line as $value): ?>
                            <?php $total = $total + ($value->qty * $value->price);
                            $row_nums += 1; ?>
                            <tr>
                                <td style="text-align: center;border: 1px solid grey;">
                                    <div class="report-f18">
                                        <?= $row_nums ?>
                                    </div>
                                </td>
                                <td style="padding-left: 8px;border: 1px solid grey;">
                                    <div class="report-f18"><?= \backend\models\Product::findName($value->product_id) ?></div>
                                </td>
                                <td style="text-align: center;border: 1px solid grey;">
                                    <div class="report-f18"><?= number_format($value->qty) ?></div>
                                </td>
                                <td style="text-align: center;border: 1px solid grey;">
                                    <div class="report-f18"><?= number_format($value->price) ?></div>
                                </td>
                                <td style="text-align: right;border: 1px solid grey;padding: 8px;">
                                    <div class="report-f18"><?= number_format($value->qty * $value->price) ?></div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if ($model_line != null): ?>
                            <?php if (count($model_line) < 10): ?>
                              <?php for($i = 0; $i < 10 - count($model_line); $i++): ?>
                                    <tr>
                                        <td style="text-align: center;border: 1px solid grey;">
                                            <div class="report-f18" style="height: 30px;">

                                            </div>
                                        </td>
                                        <td style="padding-left: 8px;border: 1px solid grey;">
                                            <div class="report-f18"></div>
                                        </td>
                                        <td style="text-align: center;border: 1px solid grey;">
                                            <div class="report-f18"></div>
                                        </td>
                                        <td style="text-align: center;border: 1px solid grey;">
                                            <div class="report-f18"></div>
                                        </td>
                                        <td style="text-align: right;border: 1px solid grey;padding: 8px;">
                                            <div class="report-f18"></div>
                                        </td>
                                    </tr>
                              <?php endfor;?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <tr>
                            <td colspan="3" rowspan="2"
                                style="text-align: left;padding-left: 10px;border: 1px solid grey;border-bottom: none;">
                               <p>หมายเหตุ: <b><?=$model->note?></b></p>
                            </td>
                            <td
                                    style="text-align: right;border: 1px solid grey;padding: 8px;border-bottom: none;">
                                <div class="report-f18">
                                    <b>รวมเงิน</b>
                                </div>
                            </td>
                            <td style="text-align: right;border: 1px solid grey;padding: 8px;border-bottom: none;">
                                <div class="report-f18"><?= number_format($total) ?></div>
                            </td>
                        </tr>
                        <tr>
<!--                            <td colspan="3"-->
<!--                                style="text-align: right;;border: 1px solid grey;border-bottom: none;border-top: none;">-->
<!---->
<!--                            </td>-->
                            <td
                                    style="text-align: right;;border: 1px solid grey;padding: 8px;">
                                <div class="report-f18">
                                    <b>ภาษีมูลค่าเพิ่ม</b>
                                </div>
                            </td>
                            <td style="text-align: right;;border: 1px solid grey;padding: 8px;">
                                <div class="report-f18">
                                    0
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"
                                style="text-align: center;border: 1px solid grey;padding: 8px;">
                                <div class="report-f18">
                                    <span>( <b><?= numtothai($total) ?> </b>  )</span>
                                </div>
                            </td>
                            <td style="text-align: right;border: 1px solid grey;padding: 8px;">
                                <div class="report-f18">
                                    <b>รวมเงินทั้งสิ้น</b>
                                </div>
                            </td>
                            <td style="text-align: right;border: 1px solid grey;padding: 8px;">
                                <div class="report-f18"><?= number_format($total) ?></div>
                            </td>
                        </tr>

                    </table>
                    <div style="height: 100px;"></div>
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 50%;text-align: center;">
                                <div class="report-f18">ผู้สั่งซื้อ ..................................................
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <div class="report-f18">ผู้ขาย ................................................</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%;text-align: center;">
                                <div class="report-f18">วันที่ ..................................................</div>
                            </td>
                            <td style="text-align: center;">
                                <div class="report-f18">วันที่ ................................................</div>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-3">
            <div class="btn btn-primary" onclick="printContent('print-area')">พิมพ์</div>
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