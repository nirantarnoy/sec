<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Job $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="job-form">

    <?php $form = ActiveForm::begin(['options'=>['id'=>'form-job']]); ?>
    <input type="hidden" class="remove-list" name="removelist" value="">
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'job_no')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'quotation_ref_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?php $model->trans_date = $model->isNewRecord?date('d-m-Y'):date('d-m-Y',strtotime($model->trans_date));?>
            <?= $form->field($model, 'trans_date')->widget(\kartik\date\DatePicker::className(),[
                    'pluginOptions'=>[
                            'format'=>'dd-mm-yyyy',
                    ]
            ]) ?>
        </div>
        <div class="col-lg-3">

                <?= $form->field($model, 'customer_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Customer::find()->where(['status'=>1])->all(), 'id', function($data){
                        return $data->first_name.' '.$data->last_name;
                    }),
                    'options' => ['placeholder' => 'Select a customer ...'],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'team_id')->widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\Team::find()->where(['status'=>1])->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Select a team ...'],
                'pluginOptions' => ['allowClear' => true],
            ]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'head_id')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'payment_status')->widget(\kartik\select2\Select2::className(),[
                    'data'=>\yii\helpers\ArrayHelper::map(\backend\models\Paymentstatus::find()->where(['status'=>1])->all(),'id','name')
            ]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'status')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table-bordered" id="table-list">
                <thead>
                <tr>
                    <th style="width: 5%;text-align: center;padding: 5px;">ลำดับที่</th>
                    <th style="width: 18%">รหัสสินค้า/รายละเอียด</th>
                    <th style="text-align: right;">ต้นทุน/หน่วย</th>
                    <th style="text-align: right;width: 10%">Discount</th>
                    <th style="text-align: right;">Dealer price</th>
                    <th style="text-align: right;width: 10%">VAT7%</th>
                    <th style="text-align: right;">รวมทุน/หน่วย</th>
                    <th style="text-align: right;width: 10%">จำนวน</th>
                    <th style="text-align: right;">รวมทุนทั้งหมด</th>
                    <th style="text-align: right;">ราคาเสนอ/หน่วย</th>
                    <th style="text-align: right;">รวมราคาเสนอ</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php if($model->isNewRecord):?>
                    <tr>
                        <td style="text-align: center;">

                        </td>
                        <td style="padding: 0">
                            <input type="hidden" class="line-product-id" name="line_product_id[]" value>
                            <input type="text" class="form-control line-product-name" name="line_product_name[]" style="border: none;width: 100%" value="">
                        </td>
                        <td style="padding: 0">
                            <input type="number" class="form-control line-cost-per-unit" name="line_cost_per_unit[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" min="0" onchange="linecal($(this))">
                        </td>
                        <td style="padding: 0">
                            <input type="number" class="form-control line-discount" name="line_discount[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" min="0" onchange="linecal($(this))">
                        </td>
                        <td style="padding: 0">
                            <input type="number" class="form-control line-dealer-price" name="line_dealer_price[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" min="0" readonly>
                        </td>
                        <td style="padding: 0">
                            <input type="number" class="form-control line-vat" name="line_vat[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" min="0" readonly>
                        </td>
                        <td style="padding: 0">
                            <input type="number" class="form-control line-total-cost-per-unit" name="line_total_cost_per_unit[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" min="0" readonly>
                        </td>
                        <td style="padding: 0">
                            <input type="number" class="form-control line-qty" name="line_qty[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" min="0" onchange="linecalqty($(this))">
                        </td>
                        <td style="padding: 0">
                            <input type="text" class="form-control line-total-cost-all" name="line_total_cost_all[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
                        </td>
                        <td style="padding: 0">
                            <input type="number" class="form-control line-quote-per-unit" name="line_quote_per_unit[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" min="0" onchange="linecalqty($(this))">
                        </td>
                        <td style="padding: 0">
                            <input type="text" class="form-control line-total-quote-price" name="line_total_quote_price[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
                        </td>
                        <td style="text-align: center;">
                            <div class="btn btn-sm btn-danger" onclick="removeline($(this))">-</div>
                        </td>
                    </tr>
                <?php else:?>
                <?php $line_no = 0;?>
                <?php if($model_line !=null):?>
                    <?php foreach ($model_line as $value):?>
                            <?php $line_no +=1;?>
                            <tr data-var="<?=$value->id?>">
                                <td style="text-align: center;">
                                   <?=$line_no;?>
                                </td>
                                <td style="padding: 0">
                                    <input type="hidden" class="line-rec-id" name="rec_id[]" value="<?=$value->id?>">
                                    <input type="hidden" class="line-product-id" name="line_product_id[]" value="<?=$value->product_id?>">
                                    <input type="text" class="form-control line-product-name" name="line_product_name[]" style="border: none;width: 100%" value="<?=\backend\models\Product::findName($value->product_id)?>">
                                </td>
                                <td style="padding: 0">
                                    <input type="number" class="form-control line-cost-per-unit" name="line_cost_per_unit[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="<?=$value->cost_per_unit?>" min="0" onchange="linecal($(this))">
                                </td>
                                <td style="padding: 0">
                                    <input type="number" class="form-control line-discount" name="line_discount[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="<?=$value->discount_per?>" min="0" onchange="linecal($(this))">
                                </td>
                                <td style="padding: 0">
                                    <input type="number" class="form-control line-dealer-price" name="line_dealer_price[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="<?=$value->dealer_price?>" min="0" readonly>
                                </td>
                                <td style="padding: 0">
                                    <input type="number" class="form-control line-vat" name="line_vat[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="<?=$value->vat_amount?>" min="0" readonly>
                                </td>
                                <td style="padding: 0">
                                    <input type="number" class="form-control line-total-cost-per-unit" name="line_total_cost_per_unit[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="<?=$value->total_cost_per_unit?>" min="0" readonly>
                                </td>
                                <td style="padding: 0">
                                    <input type="number" class="form-control line-qty" name="line_qty[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="<?=$value->qty?>" min="0" onchange="linecalqty($(this))">
                                </td>
                                <td style="padding: 0">
                                    <input type="text" class="form-control line-total-cost-all" name="line_total_cost_all[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="<?=$value->cost_total?>" readonly>
                                </td>
                                <td style="padding: 0">
                                    <input type="number" class="form-control line-quote-per-unit" name="line_quote_per_unit[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="<?=$value->quotation_per_unit_price?>" min="0" onchange="linecalqty($(this))">
                                </td>
                                <td style="padding: 0">
                                    <input type="text" class="form-control line-total-quote-price" name="line_total_quote_price[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="<?=$value->total_quotation_price?>" readonly>
                                </td>
                                <td style="text-align: center;">
                                    <div class="btn btn-sm btn-danger" onclick="removeline($(this))">-</div>
                                </td>
                            </tr>
                    <?php endforeach;?>
                <?php else:?>
                        <tr>
                            <td style="text-align: center;">

                            </td>
                            <td style="padding: 0">
                                <input type="hidden" class="line-rec-id" name="rec_id[]" value="">
                                <input type="hidden" class="line-product-id" name="line_product_id[]" value>
                                <input type="text" class="form-control line-product-name" name="line_product_name[]" style="border: none;width: 100%" value="">
                            </td>
                            <td style="padding: 0">
                                <input type="number" class="form-control line-cost-per-unit" name="line_cost_per_unit[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" min="0" onchange="linecal($(this))">
                            </td>
                            <td style="padding: 0">
                                <input type="number" class="form-control line-discount" name="line_discount[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" min="0" onchange="linecal($(this))">
                            </td>
                            <td style="padding: 0">
                                <input type="number" class="form-control line-dealer-price" name="line_dealer_price[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" min="0" readonly>
                            </td>
                            <td style="padding: 0">
                                <input type="number" class="form-control line-vat" name="line_vat[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" min="0" readonly>
                            </td>
                            <td style="padding: 0">
                                <input type="number" class="form-control line-total-cost-per-unit" name="line_total_cost_per_unit[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" min="0" readonly>
                            </td>
                            <td style="padding: 0">
                                <input type="number" class="form-control line-qty" name="line_qty[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" min="0" onchange="linecalqty($(this))">
                            </td>
                            <td style="padding: 0">
                                <input type="text" class="form-control line-total-cost-all" name="line_total_cost_all[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
                            </td>
                            <td style="padding: 0">
                                <input type="number" class="form-control line-quote-per-unit" name="line_quote_per_unit[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" min="0" onchange="linecalqty($(this))">
                            </td>
                            <td style="padding: 0">
                                <input type="text" class="form-control line-total-quote-price" name="line_total_quote_price[]" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
                            </td>
                            <td style="text-align: center;">
                                <div class="btn btn-sm btn-danger" onclick="removeline($(this))">-</div>
                            </td>
                        </tr>
                <?php endif;?>
                <?php endif;?>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td style="text-align: right;">รวมราคา</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="padding: 0">
                        <input type="text" class="form-control sub-total-1" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
                    </td>
                    <td></td>
                    <td style="padding: 0;">
                        <input type="text" class="form-control sub-total-2" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: right;">ส่วนสด</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="padding: 0;">
                        <input type="text" class="form-control discount-all" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: right;">จำนวนเงินหลังหักส่วนลด</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="padding: 0;">
                        <input type="text" class="form-control after-discount-all" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: right;">ภาษีมูลค่าเพิ่ม 7%</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="padding: 0;">
                        <input type="text" class="form-control vat-all" style="border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: right;">จำนวนเงินรวมทั้งสิ้น</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" style="padding: 0;">
                        <input type="text" class="form-control grand-total-all" style="background-color: black;color: white;border: none;width: 100%;box-sizing: border-box;text-align: right;" value="" readonly>
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br />
    <div class="form-group">
        <div class="btn btn-sm btn-primary" onclick="finditem()">เพิ่มรายการ</div>
    </div>
    <div class="form-group">
        <?php //echo Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <div class="btn btn-success" onclick="submitForm()">Save</div>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<div id="findModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3>รายการสินค้า</h3>
            </div>
            <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">-->
            <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto;scrollbar-x-position: top">-->

            <div class="modal-body">
                <input type="hidden" name="line_qc_product" class="line_qc_product" value="">
                <table class="table table-bordered table-striped table-find-list" width="100%">
                    <thead>
                    <tr>
                        <th style="width:10%;text-align: center">เลือก</th>
                        <th style="width: 10%;text-align: center">รหัส</th>
                        <th style="width: 20%;text-align: center">รายละเอียดสินค้า</th>
                        <th style="width: 15%;text-align: center">ประเภทสินค้า</th>
                        <th style="width: 15%;text-align: center">จำนวนคงเหลือ</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-success btn-emp-selected" data-dismiss="modalx" disabled><i
                            class="fa fa-check"></i> ตกลง
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                </button>
            </div>
        </div>

    </div>
</div>


<?php
$url_to_find_item = \yii\helpers\Url::to(['product/finditem'], true);
$js = <<<JS
var selecteditem = [];
var removelist = [];
$(function(){
    calTotal();
});
function linecal(e){
    var line_cost_per_unit = e.closest('tr').find(".line-cost-per-unit").val();
    var line_discount = e.closest('tr').find(".line-discount").val();
    var line_dealer_price = e.closest('tr').find(".line-dealer-price").val();
    var line_vat = e.closest('tr').find(".line-vat").val();
    var line_total_cost_per_unit = e.closest('tr').find(".line-total-cost-per-unit").val();
    var line_qty = e.closest('tr').find(".line-qty").val();
    var line_total_cost_all = e.closest('tr').find(".line-total-cost-all").val();
    var line_quote_per_unit = e.closest('tr').find(".line-quote-per-unit").val();
    //var line_total_quote_price = $(".line-total-quote-price").val();
    if(line_cost_per_unit == null || line_cost_per_unit == ""){
        line_cost_per_unit = 0;
    }
    if(line_discount == null || line_discount == ""){
        line_discount = 0;
    }
    if(line_dealer_price == null || line_dealer_price == ""){
        line_dealer_price = 0;
    }
    if(line_vat == null || line_vat == ""){
        line_vat = 0;
    }
    if(line_total_cost_per_unit == null || line_total_cost_per_unit == ""){
        line_total_cost_per_unit = 0;
    }
    if(line_qty == null || line_qty == ""){
        line_qty = 0;
    }
    if(line_total_cost_all == null || line_total_cost_all == ""){
        line_total_cost_all = 0;
    }
    if(line_quote_per_unit == null || line_quote_per_unit == ""){
        line_quote_per_unit = 0;
    }
    var dealer_price = parseFloat(line_cost_per_unit) - (parseFloat(line_cost_per_unit) * parseFloat(line_discount) / 100);
    var line_vat = parseFloat(dealer_price) * 7 /100;
    e.closest('tr').find(".line-dealer-price").val(dealer_price);
    e.closest('tr').find(".line-vat").val(line_vat);
    e.closest('tr').find(".line-total-cost-per-unit").val(parseFloat(dealer_price + line_vat).toFixed(2));
    e.closest('tr').find(".line-total-quote-price").val(0);
    
    linecalqty(e);
}
function linecalqty(e){
    var line_qty = e.closest('tr').find(".line-qty").val();
    var line_total_cost_all = e.closest('tr').find(".line-total-cost-per-unit").val();
    var line_quote_per_unit = e.closest('tr').find(".line-quote-per-unit").val();
    if(line_qty == null || line_qty == ""){
        line_qty = 0;
    }
    if(line_total_cost_all == null || line_total_cost_all == ""){
        line_total_cost_all = 0;
    }
    if(line_quote_per_unit == null || line_quote_per_unit == ""){
        line_quote_per_unit = 0;
    }
    
    var total_cost = parseFloat(line_total_cost_all) * parseFloat(line_qty);
    var total_quote_all = parseFloat(total_cost) + parseFloat(line_quote_per_unit);
    e.closest("tr").find(".line-total-cost-all").val(total_cost.toFixed(2));
    e.closest("tr").find(".line-total-quote-price").val(total_quote_all.toFixed(2));
    
    calTotal();
}
function calTotal(){
    var sub_total_1 = 0;
    var sub_total_2 = 0;
    var discount = 0;
    var after_discount = 0;
    var vat = 0;
    var all_total = 0;
    var line_discount = 0;
    var after_discount = 0;
    var sum_cost = 0;
    var sum_dealer_price = 0;
    
    $("#table-list tbody tr").each(function(){
        sub_total_1 += parseFloat($(this).find(".line-total-cost-all").val());
        sub_total_2 += parseFloat($(this).find(".line-total-quote-price").val());
        
        sum_cost += parseFloat($(this).find(".line-cost-per-unit").val());
        sum_dealer_price += parseFloat($(this).find(".line-dealer-price").val());
    });
    
    line_discount = parseFloat(sum_cost) - parseFloat(sum_dealer_price);
    after_discount = parseFloat(sub_total_2) - parseFloat(line_discount);
    vat = (parseFloat(after_discount) * 7) /100;
    all_total = parseFloat(after_discount) + parseFloat(vat);
    
    $(".sub-total-1").val(parseFloat(sub_total_1).toFixed(2));
    $(".sub-total-2").val(parseFloat(sub_total_2).toFixed(2));
    
      
    $(".discount-all").val(parseFloat(line_discount).toFixed(2));
    $(".after-discount-all").val(parseFloat(after_discount).toFixed(2));
    $(".vat-all").val(parseFloat(vat).toFixed(2));
    $(".grand-total-all").val(parseFloat(all_total).toFixed(2));
}
function finditem(){
     //   alert(customer_id);
        $.ajax({
          type: 'post',
          dataType: 'html',
          url:'$url_to_find_item',
          async: false,
          data: {},
          success: function(data){
             // alert(data);
              $(".table-find-list tbody").html(data);
              $("#findModal").modal("show");
          },
          error: function(err){
              //alert(err);
              alert('error na ja');
          }
        });
}

function addline(e){
    var tr = $("#table-list tbody tr:last");
    
                    var clone = tr.clone();
                    //clone.find(":text").val("");
                    // clone.find("td:eq(1)").text("");
                   clone.find(".line-text").val("0");
                   clone.find(".line-order-no").val("");
                   clone.find(".line-qty").val("0");
                   clone.find(".line-price").val("0");
                   clone.find(".line-total").val("0");
                   
                    clone.attr("data-var", "");
                    clone.find('.line-rec-id').val("0");
                    clone.find('.line-photo').val("");
                   
                    tr.after(clone);
    
}
function removeline(e) {
       
                if (confirm("ต้องการลบรายการนี้ใช่หรือไม่?")) {
                if (e.parent().parent().attr("data-var") != '') {
                    removelist.push(e.parent().parent().attr("data-var"));
                    $(".remove-list").val(removelist);
                }
                // alert(removelist);
                // alert(e.parent().parent().attr("data-var"));
    
                if ($("#table-list tbody tr").length == 1) {
                    $("#table-list tbody tr").each(function () {
                        $(this).find('td:eq(0)').html('');
                        $(this).find(":text").val("");
                        $(this).find(':input[type="number"]').val("0");
                       // $(this).find(".line-prod-photo").attr('src', '');
                       // $(this).find(".line-is-head").val('0').change();
                        // cal_num();
                    });
                } else {
                    e.parent().parent().remove();
                }
                // cal_linenum();
                // cal_all();
                calTotal();
            }
        
        
}
function cancelline(e) {
       
                if (confirm("ต้องการยกเลิกรายการนี้ใช่หรือไม่?")) {
                if (e.parent().parent().attr("data-var") != '') {
                    removelist.push(e.parent().parent().attr("data-var"));
                    $(".remove-list").val(removelist);
                }
                if(e.hasClass('btn-secondary')){
                    e.removeClass('btn-secondary');
                    e.addClass('btn-success');
                }else{
                    e.addClass('btn-secondary');
                    e.removeClass('btn-success');
                }
            }
        
        
}

function addselecteditem(e) {
        var id = e.attr('data-var');
        var item_id = e.closest('tr').find('.line-find-item-id').val();
      
        ///// add new 
         var item_name = e.closest('tr').find('.line-find-item-name').val();
        ///////
        if (id) {
            if (checkhas(item_id)){
                alert("รหัสสินค้าซ้ำ");
                return false;
            }
            if (e.hasClass('btn-outline-success')) {
                var obj = {};
                obj['item_id'] = id;
                obj['item_name'] = item_name;
                
                selecteditem.push(obj);
                
                e.removeClass('btn-outline-success');
                e.addClass('btn-success');
                disableselectitem();
                console.log(selecteditem);
            } else {
                
                e.removeClass('btn-success');
                e.addClass('btn-outline-success');
                
                disableselectitem();
                console.log(selecteditem);
            }
        }
}

function checkhas(item_id){
    var has = 0;
    $("#table-list tbody tr").each(function () {
       var id = $(this).closest("tr").find(".line-product-id").val();
       if (id == item_id ){
           has = 1;
       }
    });
    return has;
}

function disableselectitem() {
        if (selecteditem.length > 0) {
            $(".btn-emp-selected").prop("disabled", "");
            $(".btn-emp-selected").removeClass('btn-outline-success');
            $(".btn-emp-selected").addClass('btn-success');
        } else {
            $(".btn-emp-selected").prop("disabled", "disabled");
            $(".btn-emp-selected").removeClass('btn-success');
            $(".btn-emp-selected").addClass('btn-outline-success');
        }
}

$(".btn-emp-selected").click(function () {
        var linenum = 0;
      
        if(selecteditem.length >0){
             var tr = $("#table-list tbody tr:last");
             var last_line_photo_id = tr.closest("tr").find(".line-photo").attr("id");
    //alert(last_line_photo_id);
             for(var i=0;i<=selecteditem.length-1;i++){
               //  var new_text = selecteditem[i]['line_work_type_name'] + "\\n" + "Order No."+selecteditem[i]['line_order_no'];
                   if (tr.closest("tr").find(".line-product-id").val() == "") {
                  //  alert(line_prod_code);
                    tr.closest("tr").find(".line-rec-id").val(0);
                    tr.closest("tr").find(".line-product-id").val(selecteditem[i]['item_id']);
                    tr.closest("tr").find(".line-product-name").val(selecteditem[i]['item_name']);
                    
                    //console.log(line_prod_code);
                    } else {
                        var clone = tr.clone();
                        clone.closest("tr").find(".line-rec-id").val('0');
                        clone.closest("tr").find(".line-product-id").val(selecteditem[i]['item_id']);
                        clone.closest("tr").find(".line-product-name").val(selecteditem[i]['item_name']);
                        tr.after(clone);
                    } 
             }
                
          
        }
        
        $("#table-list tbody tr").each(function () {
           linenum += 1;
            $(this).closest("tr").find("td:eq(0)").text(linenum);
             $(this).find(':input[type="number"]').val("0");
            // $(this).closest("tr").find(".line-prod-code").val(line_prod_code);
        });
        
        selecteditem = [];
        selectedorderlineid = [];
        selecteditemgroup = [];

        $("#table-find-list tbody tr").each(function () {
            $(this).closest("tr").find(".btn-line-select").removeClass('btn-success');
            $(this).closest("tr").find(".btn-line-select").addClass('btn-outline-success');
        });
        
        $(".btn-emp-selected").removeClass('btn-success');
        $(".btn-emp-selected").addClass('btn-outline-success');
        $("#findModal").modal('hide'); 
        
        calTotal();
});

function submitForm(){
    var check_data = 0;
    $("#table-list tbody tr").each(function(){
          if($(this).closest("tr").find(".line-product-id").val() == '' || $(this).closest("tr").find(".line-total-quote-price").val() == ''){
            check_data +=1;
          } 
    });
    if(check_data > 0){
         alert('กรุณาเลือกรายละเอียดก่อนทำรายการ');
              return false;
    }else{
        //$("#table-list tbody tr").each(function(){
          //  var photo_selected_file = $(this).closest("tr").find(".line-photo").val();
          // $(this).closest("tr").find(".line-photo-index").val(photo_selected_file); 
        //});
        $("form#form-job").submit();
    }
}

JS;

$this->registerJs($js,static::POS_END);

?>