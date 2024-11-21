<?php
?>
<div id="div1">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 20%;text-align: center;vertical-align: middle;">
                            <img src="<?php echo Yii::$app->request->baseUrl; ?>/uploads/logo/mmc_new.png" alt="mmc"
                                 width="100%">
                        </td>
                        <td style="width: 40%">
                            <table>
                                <tr>
                                    <td><b>M M C Material Co.,Ltd.</b></td>
                                </tr>
                                <tr>
                                    <td>61/12 Moo 6, Taling Chan - Suphanburi Rd.</td>
                                </tr>
                                <tr>
                                    <td>Bang Mae Nang, Bang Yai, Nonthaburi 11140</td>
                                </tr>
                                <tr>
                                    <td><b>Thailand.</b></td>
                                </tr>
                                <tr>
                                    <td><b>Phone</b>: 0-2157-2949 /<b>Fax</b>: 0-2157-2950</td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 40%">
                            <table>
                                <tr>
                                    <td><b>บริษัท เอ็ม-เอ็ม-ซี แมตทีเรียล จำกัด</b></td>
                                </tr>
                                <tr>
                                    <td>61/12 หมู่ 6 ถนนตลิ่งชัน-สุพรรบุรี</td>
                                </tr>
                                <tr>
                                    <td>ต.บางแม่นาง อ.บางใหญ่</td>
                                </tr>
                                <tr>
                                    <td>จ.นนทบุรี 11140</td>
                                </tr>
                                <tr>
                                    <td><b>โทร</b>: 0-2157-2949 /<b>แฟกซ์</b>: 0-2157-2950</td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                </table>
            </div>
        </div>

    </div>
    <table style="width: 100%;margin-top: 5px;">
        <tr>
            <td style="border-top: 1px solid black;"></td>
        </tr>
    </table>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 100%;text-align: center"><b><h5>ใบเสนอราคา (Quotation)</h5></b></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%;border-collapse: collapse;border: none">
                <tr>
                    <td style="width: 60%;vertical-align: top;">
                        <table style="width: 100%;">
                            <tr>
                                <td><b>ชื่อลูกค้า / Customer
                                        Name:</b><span> <?= \backend\models\Customer::findCusFullName($model->customer_id) ?></span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>ที่อยู่ /
                                        Address:</b><span> <?= \backend\models\Customer::findFullAddress($model->customer_id) ?></span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>เรียน/Attn:</b><span> <?= \backend\models\Customer::findAttn($model->attn_id) ?></span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>เบอร์โทร /
                                        Tel:</b><span> <?= \backend\models\Customer::findPhone($model->customer_id) ?></span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Email:</b><span> <?= \backend\models\Customer::findEmail($model->customer_id) ?></span>
                                </td>
                                <td></td>
                            </tr>

                        </table>
                    </td>
                    <td style="width: 40%;vertical-align: top;">
                        <table style="width: 100%">
                            <tr>
                                <td><b>เลขที่/No:</b><span> <?= $model->quotation_no ?></span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>วันที่/Date:</b><span> <?= date('d-m-Y', strtotime($model->quotation_date)) ?></span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
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
            <p>บริษัทฯ มีความยินดีเสนอราคา</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%;border-collapse: collapse;border: 1px solid lightgrey" id="table-data">
                <thead>
                <tr>
                    <th style="width: 8%;text-align: center;border:1px solid lightgrey;border-bottom: none;">ลำดับที่
                    </th>
                    <th style="width: 45%;text-align: center;border:1px solid lightgrey;padding: 10px;border-bottom: none;">
                        รายการ
                    </th>
                    <th colspan="2"
                        style="text-align: center;border:1px solid lightgrey;border-bottom: none;width: 20%">จำนวน
                    </th>
                    <th style="width: 10%;text-align: center;border:1px solid lightgrey;border-bottom: none;">หน่วยละ
                    </th>
                    <th style="width: 15%;text-align: center;border:1px solid lightgrey;padding: 5px;border-bottom: none;">
                        จำนวนเงิน
                    </th>
                </tr>
                <tr>
                    <th style="width: 8%;text-align: center;border:1px solid lightgrey;border-top: none">No.</th>
                    <th style="width: 45%;text-align: center;border:1px solid lightgrey;padding: 5px;border-top: none">
                        Description
                    </th>
                    <th colspan="2" style="text-align: center;border:1px solid lightgrey;border-top: none">Quantity</th>
                    <th style="width: 10%;text-align: center;border:1px solid lightgrey;border-top: none">Unit Price
                    </th>
                    <th style="width: 15%;text-align: center;border:1px solid lightgrey;padding: 5px;border-top: none">
                        Amount
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $num_row = 0;
                $total = 0;
                $disc_amount = $model->discount_amt;
                $vat_amount = 0;
                $all_total = 0; ?>
                <?php foreach ($model_line as $value): ?>
                    <?php $num_row++;
                    $total += ($value->qty * $value->line_price);
                    $line_desc = '';
                    if ($value->mat_desc != '') {
                        $line_desc = '<br />' .'Mat: '. $value->mat_desc;
                    }
                    if ($value->size_desc != '') {
                        $line_desc = $line_desc . '<br />' . 'Size: ' . $value->size_desc;
                    }

                    ?>
                    <tr>
                        <td style="text-align: center;border:1px solid lightgrey;padding: 5px;"><?= $num_row ?></td>
                        <td style="border:1px solid lightgrey;padding-left: 5px;">
<!--                            --><?php //if($value->photo !=null || $value->photo !=''):?>
<!--                                <img src="--><?php //= \Yii::$app->getUrlManager()->baseUrl . '/uploads/quotation_photo/' . $value->photo ?><!--" style="width: 20%" alt="">-->
<!--                            --><?php //endif;?>
                            <?= $value->product_name != '' ? $value->product_name . $line_desc : \backend\models\Product::findName($value->product_id) ?>
                        </td>
                        <td style="text-align: center;border:1px solid lightgrey;width: 10%"><?= $value->qty ?></td>
                        <td style="text-align: center;border:1px solid lightgrey;"><?= \backend\models\Unit::findName($value->unit_id) ?></td>
                        <td style="text-align: center;border:1px solid lightgrey;"><?= number_format($value->line_price, 2) ?></td>
                        <td style="text-align: center;border:1px solid lightgrey;"><?= number_format($value->qty * $value->line_price, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if ($model_line != null): ?>
                    <?php if (count($model_line) < 10): ?>
                        <?php for ($i = 1; $i <= 10 - count($model_line); $i++): ?>
                            <tr>
                                <td style="text-align: center;border:1px solid lightgrey;padding: 5px;color: transparent">
                                    1
                                </td>
                                <td style="border:1px solid lightgrey;"></td>
                                <td style="text-align: center;border:1px solid lightgrey;width: 10%"></td>
                                <td style="text-align: center;border:1px solid lightgrey;"></td>
                                <td style="text-align: center;border:1px solid lightgrey;"></td>
                                <td style="text-align: center;border:1px solid lightgrey;"></td>
                            </tr>
                        <?php endfor; ?>
                    <?php endif; ?>
                <?php endif; ?>
                </tbody>
                <tfoot>
                <?php
                $vat_amount = (($total - $disc_amount) * 7) / 100;
                $all_total = ($total - $disc_amount) + $vat_amount;
                ?>
                <tr>
                    <td colspan="2" style="border:1px solid lightgrey;border-top:none;border-bottom: none;"></td>
                    <td colspan="3" style="border:1px solid lightgrey;padding:5px;text-align: right">ราคารวม/Total</td>
                    <td style="border:1px solid lightgrey;text-align: center;"><?= number_format($total, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="border:1px solid lightgrey;border-top:none;border-bottom: none;text-align: center;">
                        บริษัทมีความยินดีเสนอราคาตามเงื่อนไขดังนี้
                    </td>
                    <td colspan="3" style="border:1px solid lightgrey;padding:5px;text-align: right">ส่วนลด/Discount
                    </td>
                    <td style="border:1px solid lightgrey;text-align: center;"><?= number_format($disc_amount, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="border:1px solid lightgrey;border-top:none;border-bottom: none;text-align: center;">
                        Company pleased to submit our price quotation for your consideration.
                    </td>
                    <td colspan="3" style="border:1px solid lightgrey;padding:5px;text-align: right">ภาษีมูลค่าเพิ่ม/VAT
                        7%
                    </td>
                    <td style="border:1px solid lightgrey;text-align: center;"><?= number_format($vat_amount, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="border:1px solid lightgrey;border-top:none;border-bottom: none;text-align: center"></td>
                    <td colspan="3" style="border:1px solid lightgrey;padding:5px;text-align: right">ยอดรวมสุทธิ/Net
                        Total
                    </td>
                    <td style="border:1px solid lightgrey;text-align: center;">
                        <b><?= number_format($all_total, 2) ?></b></td>
                </tr>
                <tr>
                    <td colspan="3" style="border:1px solid lightgrey;padding: 5px;text-align: center"><b><span
                                    class="show-total-string"><?=$model->total_text?></span></b></td>
                    <td colspan="2" style="border:1px solid lightgrey;padding:5px;"></td>
                    <td style="border:1px solid lightgrey;"><input type="hidden" class="all-total-amt"
                                                                   value="<?= $all_total ?>"></td>
                </tr>

                </tfoot>
            </table>

        </div>
    </div>
    <div style="height: 10px;"></div>
    <div class="row">
        <div class="col-lg-6">
            <table style="width: 100%">
                <!--                <tr>-->
                <!--                    <td style="padding: 10px;">-->
                <!--                      <p>1. ระยะเวลาการผลิต 15 วันหลังรับใบสั่งซื้อ</p>-->
                <!--                      <p>2. ระยะเวลาการชำระเงิน 30 วันจากวันส่งมอบสินค้า</p>-->
                <!--                    </td>-->
                <!--                </tr>-->
                <tr>
                    <td style="padding: 10px;">
                        <p>หมายเหตุ: <b><?= $model->remark ?></b></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div style="height: 10px;"></div>
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%">
                <tr>
                    <td style="width: 33%;padding: 25px;text-align: center;">

                    </td>
                    <td style="width: 33%;padding: 25px;text-align: center;">

                    </td>
                    <td style="width: 33%;padding: 20px;text-align: center;">
                        <p>ขอแสดงความนับถือ/Yours Faithfully</p>
                        <br/>
                        <p>( นายกฤษฎา เหมือนสังข์ )</p>
                        <p>ผู้มีอำนาจลงนาม/Authorized Signature</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br/>
<table width="100%" class="table-title">
    <td style="text-align: right">
        <!--        <button id="btn-export-excel" class="btn btn-secondary">Export Excel</button>-->
        <button id="btn-print" class="btn btn-warning" onclick="printContent('div1')">Print</button>
    </td>
</table>

<br/>

<?php
$this->registerJsFile(\Yii::$app->request->baseUrl . '/js/jquery.table2excel.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$url_to_convert_num = \yii\helpers\Url::to(['order/convertnumtostring'], true);
$js = <<<JS
$(function(){
    var total_amt = $(".all-total-amt").val();
    if(total_amt != null){
      //  alert(total_amt);
      //  converNumToStr(8.03);
    }
});
function converNumToStr(num){
    $.ajax({
          type: 'post',
          dataType: 'html',
          url:'$url_to_convert_num',
          async: false,
          data: {"amount": num},
          success: function(data){
            $(".show-total-string").html(data);
          },
          error: function(err){
              alert(err);
          }
        });
}
 $("#btn-export-excel").click(function(){
  $("#table-data").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Excel Document Name"
  });
});
$(".btn-order-date").click(function(){
    $(".btn-order-type").val(1);
    if($(".btn-order-price").hasClass("btn-success")){
        $(".btn-order-price").removeClass("btn-success");
        $(".btn-order-price").addClass("btn-default");
    }
    if($(this).hasClass("btn-default")){
        $(this).removeClass("btn-default")
        $(this).addClass("btn-success");
    }
    
});
$(".btn-order-price").click(function(){
    $(".btn-order-type").val(2);
      if($(".btn-order-date").hasClass("btn-success")){
        $(".btn-order-date").removeClass("btn-success");
        $(".btn-order-date").addClass("btn-default");
    }
    if($(this).hasClass("btn-default")){
        $(this).removeClass("btn-default")
        $(this).addClass("btn-success");
    }
});
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
