<?php


$customer_id = 0;
$modelissue = \backend\models\Journalissue::find()->select(['issue_for_id'])->where(['id' => $model->issue_ref_id])->one();
if ($modelissue) {
    $modelorder = \backend\models\Order::find()->select(['customer_id'])->where(['id' => $modelissue->issue_for_id])->one();
    if ($modelorder) {
        $customer_id = $modelorder->customer_id;
    }
}

?>
<div id="div1">
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 100%;text-align: center"><h3>ใบส่งสินค้า/บิลเงินสด</h3></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3"><h6>ชื่อลูกค้า <span style="font-weight: bold;"><?= $model->order_no; ?></span>
            </h6></div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%;border-collapse: collapse;border: 1px solid lightgrey">
                <tr>
                    <td style="border: 1px solid lightgrey;padding: 10px;width: 50%;">
                        <h6>ที่อยู่:</h6>
                        <p><?= \backend\models\CUstomer::findFullAddress($customer_id) ?></p>

                    </td>
                    <td style="border: 1px solid lightgrey;padding: 10px;">
                        <h6>สถานที่จัดส่ง:</h6>
                        <p><?= \backend\models\CUstomer::findFullAddress2($customer_id) ?></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%;border-collapse: collapse;border: 1px solid lightgrey" id="table-data">
                <thead>
                <tr>
                    <th style="width: 10%;text-align: center;border:1px solid lightgrey;">ลำดับที่</th>
                    <th style="width: 15%;text-align: center;border:1px solid lightgrey;padding: 15px;">รหัสสินค้า</th>
                    <th style="text-align: center;border:1px solid lightgrey;">ชื่อสินค้า</th>
                    <th style="width: 10%;text-align: center;border:1px solid lightgrey;">หน่วย</th>
                    <th style="width: 15%;text-align: right;border:1px solid lightgrey;padding: 5px;">จำนวน</th>
                    <th style="width: 15%;text-align: right;border:1px solid lightgrey;padding: 5px;">หน่วยละ</th>
                    <th style="width: 15%;text-align: right;border:1px solid lightgrey;padding: 5px;">จำนวนเงิน</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($model_line != null): ?>
                    <?php $loop_no = 0;
                    $total_qty = 0; ?>
                    <?php foreach ($model_line as $key => $value): ?>
                        <?php
                        $loop_no++;
                        $total_qty += $value->qty;
                        ?>
                        <tr>
                            <td style="text-align: center;border:1px solid lightgrey;padding: 10px;"><?= $loop_no ?></td>
                            <td style="text-align: center;border:1px solid lightgrey;padding: 5px;"><?= \backend\models\Product::findCode($value->product_id) ?></td>
                            <td style="text-align: left;border:1px solid lightgrey;padding: 5px;"><?= $value->name ?></td>
                            <td style="text-align: center;border:1px solid lightgrey;">ชิ้น</td>
                            <td style="text-align: right;border:1px solid lightgrey;padding: 5px;"><?= number_format($value->qty, 0) ?></td>
                            <td style="text-align: center;border:1px solid lightgrey;">-</td>
                            <td style="text-align: center;border:1px solid lightgrey;">-</td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right;border:1px solid lightgrey;padding: 10px;">
                        <b>รวมทั้งสิ้น</b></td>
                    <td colspan="2" style="text-align: right;border:1px solid lightgrey;padding: 5px;">
                        <b><?= number_format($total_qty, 0) ?></b></td>
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
                    <td style="padding: 50px;border: 1px solid lightgrey">
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
                    <td style="width: 33%;border: 1px solid lightgrey;padding: 25px;text-align: center;">
                        <p>ผู้รับสินค้า ..............................................................</p>
                        <p>วันที่ ...................................................................</p>
                    </td>
                    <td style="width: 33%;border: 1px solid lightgrey;padding: 25px;text-align: center;">
                        <p>ผู้ส่งสินค้า ..............................................................</p>
                        <p>วันที่ ...................................................................</p>
                    </td>
                    <td style="width: 33%;border: 1px solid lightgrey;padding: 20px;text-align: center;">
                        <p>ผู้มีอำนาจอนุมัติ ..............................................................</p>
                        <p>วันที่ ...................................................................</p>
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
