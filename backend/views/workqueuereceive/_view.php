<?php


$date_day = date('d',strtotime($model->work_queue_date));
$date_month = \backend\helpers\Thaimonth::getTypeById((int)(date('m', strtotime($model->work_queue_date))));
$date_year = date('Y',strtotime($model->work_queue_date)) + 543;
?>
<br />
<input type="hidden" class="is-after-save" value="<?=$after_save?>">
<div id="print-area">
    <table style="width: 100%;" border="0">
        <tr>
            <td colspan="3" style="text-align: center"><h4><b>บริษัท ณโรโน่ จำกัด</b></h4></td>
        </tr>
        <tr>
            <td style="width: 33%"></td>
            <td style="text-align: center;width: 33%"><h5><b>ใบสั่งจ่ายน้ำมัน</b></h5></td>
            <td style="text-align: right;width: 33%">เลขที่ <b><?= $model->work_queue_no ?></b></td>
        </tr>
    </table>
    <br>

    <table style="width: 100%">
        <tr>
            <td style="text-align: center"><b>วันที่ <?= $date_day ?> เดือน <?= $date_month ?>
                    พ.ศ. <?= $date_year ?></b></td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td>ทะเบียนหัว <b><?= \backend\models\Car::getPlateno($model->car_id) ?></b></td>
            <!--            <td><input type="text" class="form-control"></td>-->
            <td> ทะเบียนหาง <b><?= \backend\models\Car::getPlateno($model->tail_id) ?></b></td>
            <!--            <td><input type="text" class="form-control"></td>-->
            <td> ประเภทรถ <b><?= \backend\models\Car::getCartype($model->car_id) ?></b></td>
            <!--            <td><input type="text" class="form-control"></td>-->
            <td> แรงรถ <b><?= \backend\models\Car::getHp($model->car_id) ?></b></td>
            <!--            <td><input type="text" class="form-control"></td>-->
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td>
                พนักงาน <b><?= \backend\models\Employee::findFullName($model->emp_assign) ?></b>
            </td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td>
                ต้นทาง-ปลายทาง <b><?= \backend\models\RoutePlan::findDes2($model->route_plan_id) ?></b>
            </td>
        </tr>
    </table>

    <br>
    <table style="width: 100%">
        <tr>
            <td>น้ำหนักเที่ยวไป <b><?=number_format($model->weight_on_go,2)?></b></td>
            <td>หัก <b><?=number_format($model->weight_go_deduct,2)?></b></td>
            <td>เหตุผล <b><?=$model->go_deduct_reason?></b></td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td>เที่ยวกลับ </td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td>น้ำหนักเที่ยวกลับ <b><?=number_format($model->weight_on_back,2)?></b></td>
            <td>เรทน้ำมันกลับ <b></b></td>
            <td>หัก <b><?=number_format($model->back_deduct,2)?></b></td>
            <td>เหตุผล <b><?=$model->back_reason?></b></td>
            <td>หางกลับ <b><?= \backend\models\Car::findName($model->tail_back_id) ?></b></td>
        </tr>
    </table>

    <br>
    <table style="width: 100%">
        <tr>
            <td>น้ำมัน <b></b></td>
        </tr>
    </table>

</div>
<br />
<div class="row">
    <div class="col-lg-12" style="text-align: center">
        <div class="btn btn-default btn-print" onclick="printContent('print-area')">พิมพ์</div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4" style="text-align: center;">
        <div class="btn btn-success" onclick="confirmwork()"><h3>ยืนยันรับงานและปริ้นเอกสาร</h3></div>
    </div>
    <div class="col-lg-4"></div>
</div>

<form id="form-confirm" action="<?= \yii\helpers\Url::to(['workqueuereceive/confirm'], true) ?>" method="post">
    <input type="hidden" name="work_queue_id" value="<?= $model->id ?>">
</form>
<form id="form-goto-index" action="<?= \yii\helpers\Url::to(['workqueuereceive/index'], true) ?>" method="post"></form>

<?php
$this->registerJsFile(\Yii::$app->request->baseUrl . '/js/module_index_delete.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$js = <<<JS
$(function(){
    var after_save = $(".is-after-save").val();
    if(after_save == 1){
        printContent('print-area');
        $("form#form-goto-index").submit();
    }
});
function printContent(el)
      {
         var restorepage = document.body.innerHTML;
         var printcontent = document.getElementById(el).innerHTML;
         document.body.innerHTML = printcontent;
         window.print();
         document.body.innerHTML = restorepage;
         
         // workqueConfirm(e);
         
     }
     
function confirmwork(){
   
    workqueConfirm();
    // printContent('print-area');
    // if(confirm("ยืนยันการทำรายการใช่หรือไม่ ?")){
    //     $("form#form-confirm").submit();
    // }
}     
JS;
$this->registerJs($js, static::POS_END);
?>
