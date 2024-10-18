<?php
?>
<div id="div1">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 20%"></td>
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
                        <td style="width: 40%">
                            <table>
                                <tr>
                                    <td><b>M M C Material Co.,Ltd.</b></td>
                                </tr>
                                <tr>
                                    <td>61/12 Mu 6 Tahlingshun-Supunburee Road.</td>
                                </tr>
                                <tr>
                                    <td>Bang Mae Nang,Bangyhi,Nonthaburee 11140</td>
                                </tr>
                                <tr>
                                    <td><b>Thailand.</b></td>
                                </tr>
                                <tr>
                                    <td><b>Phone</b>: 0-2157-2949 /<b>Fax</b>: 0-2157-2950</td>
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
    <br />
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
                               <td colspan="2"><b>ชื่อ/ที่อยู่ลูกค้า Cust.Name / Address</b></td>
                           </tr>
                           <tr>
                               <td colspan="2"><?= \backend\models\Customer::findFullAddress($model->customer_id) ?></td>
                           </tr>
                           <tr>
                               <td><b></b></td>
                               <td></td>
                           </tr>
                           <tr>
                               <td><b>เรียน/Attn:</b></td>
                               <td></td>
                           </tr>
                       </table>
                    </td>
                    <td style="width: 40%">
                        <table style="width: 100%">
                            <tr>
                                <td><b>เลขที่/No: </b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>วันที่/Date: </b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Email: </b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>From: </b></td>
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
                    <th style="width: 8%;text-align: center;border:1px solid lightgrey;border-bottom: none;">ลำดับที่</th>
                    <th style="width: 45%;text-align: center;border:1px solid lightgrey;padding: 10px;border-bottom: none;">รายการ</th>
                    <th colspan="2" style="text-align: center;border:1px solid lightgrey;border-bottom: none;width: 20%">จำนวน</th>
                    <th style="width: 10%;text-align: center;border:1px solid lightgrey;border-bottom: none;">หน่วยละ</th>
                    <th style="width: 15%;text-align: center;border:1px solid lightgrey;padding: 5px;border-bottom: none;">จำนวนเงิน</th>
                </tr>
                <tr>
                    <th style="width: 8%;text-align: center;border:1px solid lightgrey;border-top: none">No.</th>
                    <th style="width: 45%;text-align: center;border:1px solid lightgrey;padding: 5px;border-top: none">Description</th>
                    <th colspan="2" style="text-align: center;border:1px solid lightgrey;border-top: none">Quantity</th>
                    <th style="width: 10%;text-align: center;border:1px solid lightgrey;border-top: none">Unit Price</th>
                    <th style="width: 15%;text-align: center;border:1px solid lightgrey;padding: 5px;border-top: none">Amount</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="text-align: center;border:1px solid lightgrey;padding: 5px;">1</td>
                    <td style="border:1px solid lightgrey;">fdfdfdfd</td>
                    <td style="text-align: center;border:1px solid lightgrey;width: 10%">1</td>
                    <td style="text-align: center;border:1px solid lightgrey;">PCS</td>
                    <td style="text-align: center;border:1px solid lightgrey;">100</td>
                    <td style="text-align: center;border:1px solid lightgrey;">100</td>
                </tr>
                <?php for($i=1;$i<=5;$i++):?>
                <tr>
                    <td style="text-align: center;border:1px solid lightgrey;padding: 5px;color: transparent">1</td>
                    <td style="border:1px solid lightgrey;"></td>
                    <td style="text-align: center;border:1px solid lightgrey;width: 10%"></td>
                    <td style="text-align: center;border:1px solid lightgrey;"></td>
                    <td style="text-align: center;border:1px solid lightgrey;"></td>
                    <td style="text-align: center;border:1px solid lightgrey;"></td>
                </tr>
                <?php endfor;?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2" style="border:1px solid lightgrey;border-top:none;border-bottom: none;"></td>
                    <td colspan="3" style="border:1px solid lightgrey;padding:5px;">ราคารวมทั้งสิ้น/Total</td>
                    <td style="border:1px solid lightgrey;"></td>
                </tr>
                <tr>
                    <td colspan="2" style="border:1px solid lightgrey;border-top:none;border-bottom: none;text-align: center;">ทางบริษัทฯ ขอขอบคุณที่ให้ความสนใจ และรับไว้พิจารณา</td>
                    <td colspan="3" style="border:1px solid lightgrey;padding:5px;">ส่วนลด/Discount</td>
                    <td style="border:1px solid lightgrey;"></td>
                </tr>
                <tr>
                    <td colspan="2" style="border:1px solid lightgrey;border-top:none;border-bottom: none;text-align: center">Thanks for yours interest and consideration</td>
                    <td colspan="3" style="border:1px solid lightgrey;padding:5px;">มูลค่าสินค้า/Net Total</td>
                    <td style="border:1px solid lightgrey;"></td>
                </tr>
                <tr>
                    <td colspan="2" style="border:1px solid lightgrey;border-top:none;border-bottom: none;"></td>
                    <td colspan="3" style="border:1px solid lightgrey;padding:5px;">ภาษีมูลค่าเพิ่ม/VAT 7%</td>
                    <td style="border:1px solid lightgrey;"></td>
                </tr>
                <tr>
                    <td colspan="3" style="border:1px solid lightgrey;padding: 5px;text-align: center">()</td>
                    <td colspan="2" style="border:1px solid lightgrey;padding:5px;"></td>
                    <td style="border:1px solid lightgrey;"></td>
                </tr>

                </tfoot>
            </table>

        </div>
    </div>
    <div style="height: 10px;"></div>
    <div class="row">
        <div class="col-lg-6">
            <table style="width: 100%">
                <tr>
                    <td style="padding: 10px;">
                        <span><b>หมายเหตุ :  </b><?= $model->remark; ?></span>

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
                        <br />
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
$js = <<<JS
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
