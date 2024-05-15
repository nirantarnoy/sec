<?php
?>
    <div id="div1">
        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-lg-2">
                        <img src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/logo/ab_logo.jpg' ?>"
                             style="margin-top: 5px;max-width: 100px" alt="">
                    </div>
                    <div class="col-lg-9">
                        <div style="padding-top: 15px;">
                            <b>บริษัท แอนนาบี จำกัด</b>
                        </div>
                        <div style="padding-top: 15px;">
                            ANNAB CO.,LTD.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p style="font-size: 12px;">78/24 หมู่บ้าน เดอะคอนเนค 50 ม.3 ต.บ้านฉาง อ.เมือง จ.ปทุมธานี
                            12000(สำนักงานใหญ่)</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 100%;text-align: center;border: 1px solid lightgrey;padding: 10px;">
                            <h6><b>ใบกำกับภาษี (ต้นฉบับบ)</b></h6>
                            <h6><b>ORIGINAL CUSTOMER</b></h6>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 100%;text-align: center;border: 1px solid lightgrey;padding: 10px;">
                            <h6>สำหรับลูกค้า</h6>
                            <h6>ORIGINAL CUSTOMER</h6>
                        </td>
                    </tr>

                </table>
            </div>

        </div>
        <div style="height: 5px;"></div>
        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-lg-6">
                        <p style="font-size: 16px;">โทรศัพท์</p>
                    </div>
                    <div class="col-lg-6">
                        <p style="font-size: 16px;">แฟ็กส์ -</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p style="font-size: 16px;">เลขที่ประจำตัวผู้เสียภาษี</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 34%;text-align: left;border: 1px solid lightgrey;padding: 5px;">
                            <h6>เลขที่</h6>
                        </td>
                        <td style="text-align: left;border: 1px solid lightgrey;padding: 5px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 34%;text-align: left;border: 1px solid lightgrey;padding: 5px;">
                            <h6>วันที่เอกสาร</h6>
                        </td>
                        <td style="text-align: left;border: 1px solid lightgrey;padding: 5px;">

                        </td>
                    </tr>

                </table>
            </div>

        </div>
        <div style="height: 5px;"></div>
        <div class="row">
            <div class="co-lg-12">
                <table style="width: 100%;">
                    <tr>
                        <td rowspan="3" style="width: 59%;border: 1px solid lightgrey;padding: 10px">
                            <p style="font-size: 16px;">ลูกค้า <b><?=\backend\models\Customer::findCusFullName($model->customer_id)?></b></p>
                            <p style="font-size: 16px;">ที่อยู่ <b><?=\backend\models\CUstomer::findFullAddress($model->customer_id)?></b></p>
                        </td>
                        <td style="width: 14%;border: 1px solid lightgrey;padding: 8px;"><p style="font-size: 16px;display: table-cell;vertical-align: middle;">
                                อ้างอิงเลขที่ใบสั่งซื้อ</p></td>
                        <td style="border: 1px solid lightgrey;padding: 8px;"><b><?= $model->order_no ?></b></td>
                    </tr>
                    <tr>
                        <td style="width: 14%;border: 1px solid lightgrey;padding: 8px;"><p style="font-size: 16px;display: table-cell;vertical-align: middle;">
                                เงื่อนไขการชำระเงิน</p></td>
                        <td style="border: 1px solid lightgrey"></td>
                    </tr>
                    <tr>
                        <td style="width: 14%;border: 1px solid lightgrey;padding: 8px;"><p
                                    style="font-size: 16px;vertical-align: middle;display: table-cell;vertical-align: middle;">กำหนดชำระเงิน</p></td>
                        <td style="border: 1px solid lightgrey"></td>
                    </tr>
                </table>

            </div>

        </div>
        <div style="height: 5px;"></div>
        <div class="row">
            <div class="col-lg-12">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 5%;border: 1px solid lightgrey;text-align: center;padding: 10px;">ลำดับ</td>
                        <td style="width: 10%;border: 1px solid lightgrey;text-align: center;">รหัสสินค้า</td>
                        <td style="width: 28%;border: 1px solid lightgrey;text-align: center;">สินค้า</td>
                        <td style="width: 10%;border: 1px solid lightgrey;text-align: center;">จำนวน</td>
                        <td style="width: 10%;border: 1px solid lightgrey;text-align: center;">ราคาต่อหน่วย</td>
                        <td style="width: 10%;border: 1px solid lightgrey;text-align: right;">จำนวนเงิน</td>
                    </tr>
                    <?php
                    $line_num = 0;
                    $total_amount = 0;
                    $discount = 0;
                    $vat_per = 0;
                    $vat_amount = 0;
                    ?>
                    <?php if($model_line !=null):?>
                        <?php foreach ($model_line as $key => $value): ?>
                            <?php
                            $total_amount = $total_amount + ($value['qty']*$value['price']);
                            ?>
                            <tr>
                                <td style="border: 1px solid lightgrey;text-align: center;padding: 10px;"><?= $key+1 ?></td>
                                <td style="border: 1px solid lightgrey;text-align: center;padding: 10px;"><?= \backend\models\Product::findBarCode($value['product_id']) ?></td>
                                <td style="border: 1px solid lightgrey;text-align: left;padding: 10px;"><?= \backend\models\Product::findName($value['product_id']) ?></td>
                                <td style="border: 1px solid lightgrey;text-align: center;padding: 10px;"><?= $value['qty'] ?></td>
                                <td style="border: 1px solid lightgrey;text-align: center;padding: 10px;"><?= $value['price'] ?></td>
                                <td style="border: 1px solid lightgrey;text-align: right;padding: 10px;"><?= number_format($value['qty']*$value['price'],2) ?></td>
                            </tr>
                            <?php
                            $line_num = $key+1;
                            ?>
                        <?php endforeach; ?>
                    <?php endif;?>
                    <tr>
                        <td colspan="3" rowspan="5" style="width: 5%;border: 1px solid lightgrey;text-align: left;padding: 10px;">
                            <div style="display: table-cell;">
                                ชำระโดย             <span> </span>  <input type="checkbox"><span> </span>เงินสด    <span>  </span>     <input type="checkbox"><span> </span>เงินโอน             <span>  </span> <input type="checkbox"><span> </span>เช็ค เลขที่ ....................................................................................................
                                <div style="height: 15px;"></div>
                                <p>ธนาคาร ....................................................................... สาขา ............................................................ ลงวันที่ .....................................................................</p>
                                <p>จำนวนเงิน .....................................................................................................................................................................................................................................</p>
                            </div>

                        </td>
                        <td style="width: 5%;border: 1px solid lightgrey;text-align: left;padding: 10px;">ราคารวม</td>
                        <td colspan="2" style="width: 5%;border: 1px solid lightgrey;text-align: right;padding: 10px;"><b><?=number_format($total_amount,2)?></b></td>
                    </tr>
                    <tr>

                        <td style="width: 5%;border: 1px solid lightgrey;text-align: left;padding: 10px;">ส่วนลด</td>
                        <td colspan="2" style="width: 5%;border: 1px solid lightgrey;text-align: right;padding: 10px;"><b><?=number_format($discount,2)?></b></td>
                    </tr>
                    <tr>

                        <td style="width: 5%;border: 1px solid lightgrey;text-align: left;padding: 10px;">ยอดหักหลังส่วนลด</td>
                        <td colspan="2" style="width: 5%;border: 1px solid lightgrey;text-align: right;padding: 10px;"><b><?=number_format(($total_amount - $discount),2)?></b></td>
                    </tr>
                    <tr>

                        <td style="width: 5%;border: 1px solid lightgrey;text-align: left;padding: 10px;">มูลค่ารวมก่อนภาษี</td>
                        <td colspan="2" style="width: 5%;border: 1px solid lightgrey;text-align: right;padding: 10px;"><b><?=number_format(($total_amount - $discount),2)?></b></td>
                    </tr>
                    <tr>

                        <td style="width: 5%;border: 1px solid lightgrey;text-align: left;padding: 10px;">จำนวนภาษีมูลค่าเพิ่ม</td>
                        <td colspan="2" style="width: 5%;border: 1px solid lightgrey;text-align: right;padding: 10px;"><b><?=number_format($vat_amount,2)?></b></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="width: 5%;border: 1px solid lightgrey;text-align: center;padding: 10px;">
                            <input type="hidden" class="total-amount" value="<?=($total_amount - $discount) + $vat_amount?>">
                            <span class="total-amount-text" style="font-weight: bold;"></span>
                        </td>
                        <td style="width: 5%;border: 1px solid lightgrey;text-align: left;padding: 10px;">ราคาสุทธิ</td>
                        <td colspan="2" style="width: 5%;border: 1px solid lightgrey;text-align: right;padding: 10px;"><b><?=number_format(($total_amount - $discount) + $vat_amount,2)?></b></td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="height: 5px;"></div>
        <div class="row">
            <div class="col-lg-12">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 25%;border: 1px solid lightgrey;text-align: center;padding: 10px;border-right: none;">
                            <div style="height: 35px;"></div>
                            <p>.......................................................................................</p>
                            <p>ผู้รับสินค้า</p>
                            <p>วันที่ ............................................................................</p>
                        </td>
                        <td style="width: 25%;border: 1px solid lightgrey;text-align: center;border-left: none;border-right: none;">
                            <div style="height: 35px;"></div>
                            <p>.......................................................................................</p>
                            <p>ผู้ส่งสินค้า</p>
                            <p>วันที่ ............................................................................</p>
                        </td>
                        <td style="width: 25%;border: 1px solid lightgrey;text-align: center;border-right: none;border-left: none;">
                            <div style="height: 35px;"></div>
                            <p>.......................................................................................</p>
                            <p>ผู้รับเงิน</p>
                            <p>วันที่ ............................................................................</p>
                        </td>
                        <td style="width: 25%;border: 1px solid lightgrey;text-align: center;border-left: none;">
                            <div style="height: 35px;"></div>
                            <p>.......................................................................................</p>
                            <p>ผู้อนุมัติ</p>
                            <p>วันที่ ............................................................................</p>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
    <br />
    <table width="100%" class="table-title">
        <td style="text-align: right">
            <!--            <button id="btn-export-excel" class="btn btn-secondary">Export Excel</button>-->
            <button id="btn-print" class="btn btn-warning" onclick="printContent('div1')">Print</button>
        </td>
    </table>

    <br/>
<?php
$url_to_convertnumtotext = \yii\helpers\Url::to(['order/convertnumtostring'], true);
$this->registerJsFile(\Yii::$app->request->baseUrl . '/js/jquery.table2excel.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$js = <<<JS
 $(function(){
    var total_amount = $(".total-amount").val();
    //alert(total_amount);
    shownumtotext(total_amount); 
 });

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
function shownumtotext(nums){
    $.ajax({
      type: 'post',
      dataType: 'html',
      url:'$url_to_convertnumtotext',
      async: false,
      data: {'amount': nums},
      success: function(data){
         // alert(data);
          $(".total-amount-text").html(data);
      },
      error: function(err){
          alert(err);
      }
      
    });
}     
JS;
$this->registerJs($js, static::POS_END);
?>