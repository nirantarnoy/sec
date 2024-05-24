<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Deliveryorder $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="deliveryorder-form">

    <?php $form = ActiveForm::begin(); ?>
    <input type="hidden" class="current-order-id" value="<?=$model->id?>">
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'order_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?php $model->trans_date=$model->isNewRecord ? date('d/m/Y') : date('d/m/Y',strtotime($model->trans_date)); ?>
            <?= $form->field($model, 'trans_date')->widget(\kartik\date\DatePicker::className(),[
                    'value' => date('d/m/Y')
            ]) ?>
        </div>
        <div class="col-lg-3">
            <label for="">เลขที่ใบเบิก</label>
            <input type="text" class="form-control" readonly value="<?=\backend\models\Journalissue::findJournalNo($model->issue_ref_id)?>">
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'issue_ref_id')->hiddenInput()->label(false) ?>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12"><h5>จัดการสินค้าที่ต้องจัดส่ง</h5></div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-bordered" id="table-list-top">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%;">รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th style="width: 10%;">จำนวนเบิก</th>
                    <th style="width: 10%;">ExpDate</th>
                    <th style="width: 10%;">จำนวน/กล่อง</th>
                    <th style="width: 10%;">จำนวนกล่อง</th>
                    <th style="width: 10%;">จำนวนเศษ</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($model_cal_line != null): ?>
                    <?php $line_num_cal = 0; ?>
                    <?php foreach ($model_cal_line as $value_cal): ?>
                        <?php
                        $line_num_cal += 1;
                        $line_exp_date = '';
                        $model_exp_date = \backend\models\Stocksum::findExpDate($value_cal->stock_sum_id);
                        ?>
                        <tr data-var="<?= $value_cal->id ?>">
                            <td style="text-align: center;"><?= $line_num_cal; ?></td>
                            <td>
                                <input type="hidden" class="line-rec-idx" name="line_rec_idx[]" value="<?=$value_cal->id ?>">
                                <input type="hidden" class="line-stock-sum-idx" name="line_stock_sum_idx[]" value="<?=$value_cal->stock_sum_id?>">
                                <input type="hidden" class="line-product-idx" name="line_product_idx[]"
                                       value="<?=$value_cal->product_id?>">
                                <input type="text" class="form-control line-product-codex"
                                       name="line_product_codex[]"
                                       value="<?=\backend\models\Product::findSku($value_cal->product_id)?>"
                                       readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control line-product-namex"
                                       name="line_product_namex[]"
                                       value="<?=\backend\models\Product::findName($value_cal->product_id)?>" readonly
                                >
                            </td>

                            <td>
                                <input type="hidden" class="line-issue-origin-qtyx" value="" name="line_issue_origin_qtyx[]">
                                <input type="number" class="form-control line-issue-qtyx" name="line_issue_qtyx[]"
                                       value="<?=$value_cal->issue_qty?>"
                                       onchange="linecalissueqty($(this))">
                            </td>
                            <td>
                                <input type="text" class="form-control line-exp-datex" name="line_exp_datex[]"
                                       value="<?=$model_exp_date?>" readonly>
                            </td>
                            <td>
                                <input type="number" class="form-control line-per-box-qtyx" name="line_per_box_qtyx[]"
                                       value="<?=$value_cal->qty_per_pack?>"
                                       onchange="linecaldoperbox($(this))">
                            </td>
                            <td>
                                <input type="number" class="form-control line-box-qtyx" name="line_box_qtyx[]"
                                       value="<?=$value_cal->total_pack?>"
                                       onchange="" readonly>
                                <input type="hidden" class="line-onhand-qtyx" name="line_onhand_qtyx[]" value="">
                            </td>
                            <td>
                                <input type="number" class="form-control line-diff-qtyx" name="line_diff_qtyx[]"
                                       value="<?=$value_cal->left_qty?>"
                                       onchange="" readonly>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr data-var="0">
                        <td style="text-align: center;"></td>
                        <td>
                            <input type="hidden" class="line-rec-idx" name="line_rec_idx[]" value="0">
                            <input type="hidden" class="line-stock-sum-idx" name="line_stock_sum_idx[]" value="0">
                            <input type="hidden" class="line-product-idx" name="line_product_idx[]"
                                   value="">
                            <input type="text" class="form-control line-product-codex"
                                   name="line_product_codex[]"
                                   value=""
                                   readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control line-product-namex"
                                   name="line_product_namex[]"
                                   value="" readonly
                            >
                        </td>

                        <td>
                            <input type="hidden" class="line-issue-origin-qtyx" value="">
                            <input type="number" class="form-control line-issue-qtyx" name="line_issue_qtyx[]"
                                   value="0"
                                   onchange="linecalissueqty($(this))">
                        </td>
                        <td>
                            <input type="text" class="form-control line-exp-datex" name="line_exp_datex[]"
                                   value="" readonly>
                        </td>
                        <td>
                            <input type="number" class="form-control line-per-box-qtyx" name="line_per_box_qtyx[]"
                                   value="0"
                                   onchange="linecaldoperbox($(this))">
                        </td>
                        <td>
                            <input type="number" class="form-control line-box-qtyx" name="line_box_qtyx[]"
                                   value="0"
                                   onchange="" readonly>
                            <input type="hidden" class="line-onhand-qtyx" name="line_onhand_qtyx[]" value="">
                        </td>
                        <td>
                            <input type="number" class="form-control line-diff-qtyx" name="line_diff_qtyx[]"
                                   value="0"
                                   onchange="" readonly>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
                <tfoot>
                <tr>

                    <td colspan="3">
                        <button type="button" class="btn btn-info btn-sm" onclick="addproductmodal()">จัดสินค้า</button>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12"><h5>รายละเอียด</h5></div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-bordered" id="table-list-main">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%;">รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>รายละเอียด</th>
                    <th style="width: 15%;">จำนวน</th>
                    <th style="width: 10%;">หน่วยนับ</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($model_line != null): ?>
                    <?php $line_num = 0; ?>
                    <?php foreach ($model_line as $value): ?>
                        <?php $line_num += 1; ?>
                        <tr data-var="<?= $value->id ?>">
                            <td style="text-align: center;"><?= $line_num; ?></td>
                            <td>
                                <input type="hidden" name="line_rec_id[]" value="<?= $value->id ?>">
                                <input type="hidden" class="line-product-id" name="line_product_id[]"
                                       value="<?= $value->product_id ?>">
                                <input type="text" class="form-control line-product-code"
                                       name="line_product_code[]"
                                       value="<?= \backend\models\Product::findCode($value->product_id) ?>"
                                       readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control line-product-name"
                                       name="line_product_name[]"
                                       value="<?= $value->name?>" readonly
                                >
                            </td>
                            <td>
                                <input type="text" class="form-control line-product-name-description"
                                       name="line_product_name_description[]"
                                       value="<?= $value->description?>"
                                >
                            </td>

                            <td>
                                <input type="number" class="form-control line-qty" name="line_qty[]"
                                       value="<?= $value->qty ?>"
                                       onchange="linecal($(this))">
                            </td>
                            <td style="text-align: center;">
                                ชิ้น
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr data-var="0">
                        <td style="text-align: center;"></td>
                        <td>
                            <input type="hidden" name="line_rec_id[]" value="0">
                            <input type="hidden" class="line-product-id" name="line_product_id[]"
                                   value="">
                            <input type="text" class="form-control line-product-code"
                                   name="line_product_code[]"
                                   value=""
                                   readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control line-product-name"
                                   name="line_product_name[]"
                                   value="" readonly
                            >
                        </td>
                        <td>
                            <input type="text" class="form-control line-product-name-description"
                                   name="line_product_name_description[]"
                                   value=""
                            >
                        </td>
                        <td>
                            <input type="number" class="form-control line-qty" name="line_qty[]"
                                   value="0"
                                   onchange="linecal($(this))">
                        </td>
                        <td style="text-align: center;">
                            ชิ้น
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label for="">หมายเหตุ</label>
            <?= $form->field($model, 'remark')->textarea()->label(false) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<div id="findModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-lg-12">
                        <b>เลือกรายการสินค้า <span class="checkseleted"></span></b>
                    </div>
                </div>
            </div>
            <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">-->
            <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto;scrollbar-x-position: top">-->

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12" style="text-align: right">
                        <button class="btn btn-outline-success btn-emp-selected" data-dismiss="modalx" disabled><i
                                    class="fa fa-check"></i> ตกลง
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                    class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                        </button>
                    </div>
                </div>
                <div style="height: 10px;"></div>
                <input type="hidden" name="line_qc_product" class="line_qc_product" value="">
                <table class="table table-bordered table-striped table-find-list" width="100%">
                    <thead>
                    <tr>
                        <th style="text-align: center;width: 10%">เลือก</th>
                        <th style="width: 15%;text-align: center;">รหัสสินค้า</th>
                        <th style="text-align: center;">ชื่อสินค้า</th>
                        <th style="width: 15%;text-align: center;">วันหมดอายุ</th>
                        <th style="text-align: right;width: 15%">จำนวนคงเหลือ</th>
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
$url_to_find_stock = \yii\helpers\Url::to(['deliveryorder/findstock'], true);
$js=<<<JS
var selecteditem = [];
$(function(){
   $(".btn-emp-selected").click(function () {
        var line_count = 0;
        
        $("#table-list-top tbody tr").each(function () {
            if($(this).closest('tr').find('.line-car-emp-code').val()  != ''){
                // alert($(this).closest('tr').find('.line-car-emp-code').val());
             line_count += 1;   
            }
        });
        
        if (selecteditem.length > 0) {
           
            for (var i = 0; i <= selecteditem.length - 1; i++) {
                var product_id = selecteditem[i]['product_id'];
                var sku = selecteditem[i]['sku'];
                var product_name = selecteditem[i]['product_name'];
                var issue_qty = selecteditem[i]['issue_qty'];
                var qty = selecteditem[i]['qty'];
                var exp_date = selecteditem[i]['expired_date'];
                var line_id = selecteditem[i]['id'];
                
                var tr = $("#table-list-top tbody tr:last");
                
                if (tr.closest("tr").find(".line-product-idx").val() == "") {
                  //  alert(line_prod_code);
                    tr.closest("tr").find(".line-product-idx").val(product_id);
                    tr.closest("tr").find(".line-product-codex").val(sku);
                    tr.closest("tr").find(".line-product-namex").val(product_name);
                    tr.closest("tr").find(".line-issue-qtyx").val(issue_qty);
                    tr.closest("tr").find(".line-exp-datex").val(exp_date);
                    tr.closest("tr").find(".line-issue-qtyx").val(issue_qty);
                    tr.closest("tr").find(".line-issue-origin-qtyx").val(issue_qty);
                    tr.closest("tr").find(".line-onhand-qtyx").val(qty);
                    tr.closest("tr").find(".line-stock-sum-idx").val(line_id);
                //    tr.closest("tr").find(".line").val(exp_date);
                    //console.log(line_prod_code);
                } else {
                    //alert("dd");
                   // console.log(line_prod_code);
                    //tr.closest("tr").find(".line_code").css({'border-color': ''});
                    var has_record = 0;
                    $("#table-list-top tbody tr").each(function () {
                        if($(this).closest('tr').find('.line-stock-sum-idx').val() == line_id){
                            has_record = 1;
                        }
                    })
                    
                    if(has_record == 0){
                          var clone = tr.clone();
                        clone.find(":text").val("");
                        clone.closest("tr").find(".line-rec-idx").val(0);
                        clone.closest("tr").find(".line-per-box-qtyx").val("");
                        clone.closest("tr").find(".line-box-qtyx").val("");
                        clone.closest("tr").find(".line-diff-qtyx").val("");
                        clone.closest("tr").find(".line-product-idx").val(product_id);
                        clone.closest("tr").find(".line-product-codex").val(sku);
                        clone.closest("tr").find(".line-product-namex").val(product_name);
                        clone.closest("tr").find(".line-issue-qtyx").val(issue_qty);
                        clone.closest("tr").find(".line-issue-origin-qtyx").val(issue_qty);
                        clone.closest("tr").find(".line-exp-datex").val(exp_date);
                        clone.closest("tr").find(".line-issue-qtyx").val(issue_qty);
                        clone.closest("tr").find(".line-onhand-qtyx").val(qty);
                        clone.closest("tr").find(".line-stock-sum-idx").val(line_id);
                        tr.after(clone);
                    }

                    
                    //cal_num();
                }
            }
         
        }
       
        selecteditem = [];

        $("#table-find-list tbody tr").each(function () {
            $(this).closest("tr").find(".btn-line-select").removeClass('btn-success');
            $(this).closest("tr").find(".btn-line-select").addClass('btn-outline-success');
        });
        
        $(".btn-emp-selected").removeClass('btn-success');
        $(".btn-emp-selected").addClass('btn-outline-success');
        $("#findModal").modal('hide');
    }); 
});
function addproductmodal(){
   // $('#findModal').modal('show');
    var order_id = $('.current-order-id').val();
  // alert(customer_id);
    $.ajax({
      type: 'post',
      dataType: 'html',
      url:'$url_to_find_stock',
      async: false,
      data: {'do_id': order_id},
      success: function(data){
       //   alert(data);
          $(".table-find-list tbody").html(data);
          $("#findModal").modal("show");
      },
      error: function(err){
          alert(err);
      }
      
    });
}
function addselecteditem(e) {
        var id = e.attr('data-var');
        var do_line_id = e.closest('tr').find('.line-find-do-line-id').val();
        var product_id = e.closest('tr').find('.line-find-product-id').val();
        var product_sku = e.closest('tr').find('.line-find-product-sku').val();
        var product_name = e.closest('tr').find('.line-find-product-name').val();
        var expired_date = e.closest('tr').find('.line-find-product-expired-date').val();
        var issue_qty = e.closest('tr').find('.line-find-product-issue-qty').val();
        var qty = e.closest('tr').find('.line-find-product-qty').val();
        
        // var old_qty = 0;
        // $("#table-list-top tbody tr").each(function () {
        //     if($(this).closest('tr').find('.line-product-idx').val() == product_id){
        //         old_qty += parseFloat($(this).closest('tr').find('.line-issue-qtyx').val());
        //     }
        // }
        //issue_qty = parseFloat(issue_qty) - parseFloat(old_qty);
        
        
        
        ///////
        if (id) {
            // if(checkhasempdaily(id)){
            //     alert("คุณได้ทำการจัดรถให้พนักงานคนนี้ไปแล้ว");
            //     return false;
            // }
             var total_selected_qty = 0;
            $("#table-list-top tbody tr").each(function (){
                if($(this).closest('tr').find('.line-product-idx').val() == product_id){
                    total_selected_qty += parseFloat($(this).closest('tr').find('.line-issue-qtyx').val());
                }  
            });
            
            
            if(parseFloat(total_selected_qty)>=parseFloat(issue_qty)){
                alert("เลือกจำนวนสำหรับเบิกครบแล้ว");
                return false;
            }else{
                issue_qty = parseFloat(issue_qty) - parseFloat(total_selected_qty);
            }
            
            
            if (e.hasClass('btn-outline-success')) {
                var obj = {};
                obj['id'] = id;
                obj['sku'] = product_sku;
                obj['product_id'] = product_id;
                obj['product_name'] = product_name;
                obj['issue_qty'] = issue_qty;
                obj['qty'] = qty;
                obj['expired_date'] = expired_date;
                obj['do_line_id'] = do_line_id;
                selecteditem.push(obj);
            
             
                e.removeClass('btn-outline-success');
                e.addClass('btn-success');
                disableselectitem();
                console.log(selecteditem);
            } else {
                //selecteditem.pop(id);
                $.each(selecteditem, function (i, el) {
                    if (this.id == id) {
                        selecteditem.splice(i, 1);
                        console.log(selecteditem);
                    }
                });
                e.removeClass('btn-success');
                e.addClass('btn-outline-success');
                
                disableselectitem();
                console.log(selecteditem);
            }
        }
      
        
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
    
 function linecaldoperbox(e){
    // var boxqty = e.val();
    // var issue_qty = e.closest('tr').find('.line-issue-qtyx').val();
    // var total = (issue_qty/ boxqty);
    // e.closest('tr').find('.line-box-qtyx').val(total);
    // e.closest('tr').find('.line-diff-qtyx').val(0);
     var product_id = e.closest('tr').find('.line-product-idx').val();
    var qty = e.closest('tr').find('.line-issue-qtyx').val();
    var boxqty = e.val();
    var total = parseFloat(qty) / parseFloat(boxqty);
    var diff_qty = 0;
    //alert(Math.floor(parseFloat(total)));
    var convert_qty = Math.floor(parseFloat(total)) * parseFloat(boxqty);
    diff_qty = qty - convert_qty;
    
    if(parseFloat(qty)< parseFloat(boxqty)){
        diff_qty= qty;
    }
    
    e.closest('tr').find('.line-box-qtyx').val(Math.floor(parseFloat(total)));
     e.closest('tr').find('.line-diff-qtyx').val(diff_qty);
     
     var text_desc = '';
        if(Math.floor(parseFloat(total))>0){
            text_desc = Math.floor(parseFloat(total)) + " กล่อง"; 
        }
        if(diff_qty > 0){
            text_desc += " เศษ "+ diff_qty + " ชิ้น";
        }
       
        updateDescriptionline(product_id,text_desc);
 }  
 function linecalissueqty(e){
    var qty = e.val();
    var origin_qty = e.closest('tr').find('.line-issue-origin-qtyx').val();
    var product_id = e.closest('tr').find('.line-product-idx').val();
    var current_stock_qty = e.closest('tr').find('.line-onhand-qtyx').val();
    
    if(product_id != ''){
      //  alert(current_stock_qty +' '+ origin_qty);
      
        if(parseFloat(qty) > parseFloat(current_stock_qty)){
            alert("จำนวนสำหรับเบิกเกินจำนวนคงเหลือ");
            e.val(origin_qty);
            return false;
        }else{
            if(parseFloat(qty) > parseFloat(origin_qty)){
                alert("จำนวนสำหรับเบิกเกินจำนวนที่ต้องการเบิก");
                e.val(origin_qty);
                return false;
            }else{
                
               var is_over_qty = checkOverqty(product_id,qty,e,origin_qty);
    
               if(is_over_qty == 0){
                  var boxqty = e.closest('tr').find('.line-per-box-qtyx').val();
                    var total = parseFloat(qty) / parseFloat(boxqty);
                    var diff_qty = 0;
                    //alert(Math.floor(parseFloat(total)));
                    var convert_qty = Math.floor(parseFloat(total)) * parseFloat(boxqty);
                    diff_qty = qty - convert_qty;
                    
                    if(parseFloat(qty)< parseFloat(boxqty)){
                        diff_qty= qty;
                    }
                    
                    e.closest('tr').find('.line-box-qtyx').val(Math.floor(parseFloat(total)));
                    e.closest('tr').find('.line-diff-qtyx').val(diff_qty);
                    
                    // var text_desc = '';
                    // if(Math.floor(parseFloat(total))>0){
                    //     text_desc = Math.floor(parseFloat(total)) + "กล่อง"; 
                    // }
                    // if(diff_qty > 0){
                    //     text_desc += " เศษ "+ diff_qty + " ชิ้น";
                    // }
                   
                    updateDescriptionline(product_id); 
               }else{
                   e.val(origin_qty);
                   updateDescriptionline(product_id);
               }
                
            }
            
        }
        
    }
    
 }
 
 function checkOverqty(product_id,qty,e,origin_qty){
    var res = 0;
    if(product_id !=''){
        $("#table-list-main tbody tr").each(function(){
           if($(this).find('.line-product-id').val()==product_id){
               // alert('main qty is '+$(this).find('.line-qty').val());
               // alert('qty is '+qty);
               if(parseFloat($(this).find('.line-qty').val()) < parseFloat(qty)){
                   alert('จำนวนสินค้าเกินจำนวนที่ต้องการเบิก');
                   res = 100;
                   return res;
               }
           } 
        });
    }
    return res;
 }
 
 function updateDescriptionline(product_id){
    if(product_id !=''){
        var box_qty = 0;
        var diff_qty = 0;
        var qty_per_box = 0;
        var text = '';
        $("#table-list-top tbody tr").each(function(){
           if($(this).find('.line-product-idx').val() == product_id){
               box_qty += parseFloat($(this).find('.line-box-qtyx').val());
               diff_qty += parseFloat($(this).find('.line-diff-qtyx').val());
               qty_per_box = parseFloat($(this).find('.line-per-box-qtyx').val());
           } 
        });
        
        // if(box_qty>0){
        //     text = 'Pack Size '+ box_qty + " กล่อง ";
        // }
        // if(diff_qty>0){
        //     text += " เศษ "+ diff_qty + " ชิ้น";  
        // }
        
         if(box_qty>0){
            text = 'Pack Size '+ box_qty + "X"  + qty_per_box;
        }
        if(diff_qty>0){
            text += " + "+ diff_qty + " = "+ (box_qty*qty_per_box+diff_qty);  
        }else{
            text += " = "+ (box_qty*qty_per_box);
        }
        
        $("#table-list-main tbody tr").each(function(){
           if($(this).find('.line-product-id').val() == product_id){
               $(this).closest("tr").find(".line-product-name-description").val(text);
           } 
        });
    }
 }
JS;
$this->registerJs($js,static::POS_END);
?>