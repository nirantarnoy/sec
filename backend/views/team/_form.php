<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Unit $model */
/** @var yii\widgets\ActiveForm $form */

$yesno = [['id' => 0, 'name' => 'No'], ['id' => 1, 'name' => 'Yes'],];
?>

<div class="team-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className())->label(false) ?>

        </div>
        <div class="col-lg-1"></div>
    </div>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="label">สมาชิกทีม</div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <table class="table table-bordered" id="table-list">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th>พนักงาน</th>
                    <th style="width: 20%">หัวหน้าทีม</th>
                    <th style="width: 8%;text-align: right;"></th>
                </tr>
                </thead>
                <tbody>
                <?php if ($model->isNewRecord): ?>
                    <tr>
                        <td style="text-align: center;"></td>
                        <td>
                            <input type="hidden" class="line-emp-id" name="line_emp_id[]">
                            <input type="text" class="form-control" name="emp_name[]" value="">
                        </td>
                        <td>
                            <select name="line_is_head" id="" class="form-control line-is-head">
                                <?php foreach ($yesno as $y): ?>
                                    <option value="<?= $y['id'] ?>"><?= $y['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td style="text-align: center">
                            <div class="btn btn-sm btn-danger" onclick="removeline($(this))">ลบ</div>
                        </td>
                    </tr>
                <?php else: ?>

                <?php endif; ?>

                </tbody>
                <tfoot>
                <tr>
                    <td style="text-align: center;">
                        <div class="btn btn-sm btn-primary" onclick="finditem()">เพิ่ม</div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
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
                            <th style="width: 20%;text-align: center">ชื่อพนักงาน</th>
                            <th style="width: 20%;text-align: center">รายละเอียด</th>
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
$js=<<<JS
$(function(){
    
});
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

function getAttn(e){
     $.ajax({
          type: 'post',
          dataType: 'html',
          url:'$url_to_find_attn',
          async: false,
          data: {'id': e.val()},
          success: function(data){
            $("#select-attn-id").html(data);
          },
          error: function(err){
              alert(err);
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
                        $(this).find(":text").val("");
                       // $(this).find(".line-prod-photo").attr('src', '');
                        $(this).find(".line-item-qty").val('');
                        $(this).find(".line-item-price").val('');
                        $(this).find(".line-item-total").val('');
                        $(this).find(".line-qty").val('');
                        $(this).find(".line-photo").val("");
                        // cal_num();
                    });
                } else {
                    e.parent().parent().remove();
                }
                // cal_linenum();
                // cal_all();
                calall();
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
         var item_code = e.closest('tr').find('.line-find-item-code').val();
         var item_name = e.closest('tr').find('.line-find-item-name').val();
         var onhand = e.closest('tr').find('.line-find-onhand-qty').val();
         // var warehouse_id = e.closest('tr').find('.line-find-warehouse-id').val();
         // var warehouse_name = e.closest('tr').find('.line-find-warehouse-name').val();
         var price = e.closest('tr').find('.line-find-price').val();
         var unit_id = e.closest('tr').find('.line-find-unit-id').val();
         var unit_name = e.closest('tr').find('.line-find-unit-name').val();
         var is_drummy = e.closest('tr').find('.line-find-is-drummy').val();
        ///////
        if (id) {
            if (checkhas(item_id, is_drummy)){
                alert("รหัสสินค้าซ้ำ");
                return false;
            }
            if (e.hasClass('btn-outline-success')) {
                var obj = {};
                obj['id'] = id;
                obj['item_id'] = item_id;
                obj['item_code'] = item_code;
                obj['item_name'] = item_name;
                obj['qty'] = onhand;
                // obj['warehouse_id'] = warehouse_id;
                // obj['warehouse_name'] = warehouse_name;
                obj['price'] = price;
                obj['unit_id'] = unit_id;
                obj['unit_name'] = unit_name;
                obj['is_drummy'] = is_drummy;
                
                selecteditem.push(obj);
                selectedorderlineid.push(obj['id']);
                    // var obj_after = {};
                    // obj_after['qty'] = order_line_qty;
                    // obj_after['price'] = order_line_price;
                    // obj_after['discount'] = 0;
                    // obj_after['total'] = (order_line_qty * order_line_price);
                    //
                    // alert(obj_after['product_group_id']);
                    // alert(obj_after['product_group_name']);
                    // alert(obj_after['qty']);
                    
            
                e.removeClass('btn-outline-success');
                e.addClass('btn-success');
                disableselectitem();
                console.log(selecteditem);
            } else {
                //selecteditem.pop(id);
                $.each(selecteditem, function (i, el) {
                    if (this.id == id) {
                        var qty = this.qty;
                        selecteditem.splice(i, 1);
                        selectedorderlineid.splice(i,1);
                      //  deleteorderlineselected(product_group_id, qty); // update data in selected list
                        console.log(selecteditemgroup);
                      //  caltablecontent(); // refresh table below
                    }
                });
                e.removeClass('btn-success');
                e.addClass('btn-outline-success');
                
                disableselectitem();
                console.log(selecteditem);
                console.log(selectedorderlineid);
                console.log(selecteditemgroup);
            }
        }
        $(".orderline-id-list").val(selectedorderlineid);
}

function checkhas(item_id , is_drummy){
    var has = 0;
    $("#table-list tbody tr").each(function () {
       var id = $(this).closest("tr").find(".line-product-id").val();
       if (id == item_id && is_drummy != 1){
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
        var line_count = 0;
      
        if(selecteditem.length >0){
             var tr = $("#table-list tbody tr:last");
             var last_line_photo_id = tr.closest("tr").find(".line-photo").attr("id");
    //alert(last_line_photo_id);
             for(var i=0;i<=selecteditem.length-1;i++){
               //  var new_text = selecteditem[i]['line_work_type_name'] + "\\n" + "Order No."+selecteditem[i]['line_order_no'];
                   if (tr.closest("tr").find(".line-product-id").val() == "") {
                  //  alert(line_prod_code);
            
                    tr.closest("tr").find(".line-product-id").val(selecteditem[i]['item_id']);
                    tr.closest("tr").find(".line-product-code").val(selecteditem[i]['item_code']);
                    tr.closest("tr").find(".line-product-name").val(selecteditem[i]['item_name']);
                    tr.closest("tr").find(".line-qty").val(0);
                    // tr.closest("tr").find(".line-product-warehouse-id").val(selecteditem[i]['warehouse_id']);
                    // tr.closest("tr").find(".line-product-warehouse-name").val(selecteditem[i]['warehouse_name']);
                    tr.closest("tr").find(".line-price").val(selecteditem[i]['price']);
                    tr.closest("tr").find(".line-product-unit-id").val(selecteditem[i]['unit_id']);
                    tr.closest("tr").find(".line-product-unit-name").val(selecteditem[i]['unit_name']);
                    tr.closest("tr").find(".line-photo").val("");
                    
                    if(selecteditem[i]['is_drummy'] == 1){
                        tr.closest("tr").find(".line-product-name").prop("readonly", "");
                    }else{
                        tr.closest("tr").find(".line-product-name").prop("readonly", "readonly");
                    }
                    //console.log(line_prod_code);
                    } else {
                       
                        var clone = tr.clone();
                        clone.closest("tr").find(".line-rec-id").val('0');
                        clone.closest("tr").find(".line-product-id").val(selecteditem[i]['item_id']);
                        clone.closest("tr").find(".line-product-code").val(selecteditem[i]['item_code']);
                        clone.closest("tr").find(".line-product-name").val(selecteditem[i]['item_name']);
                        clone.closest("tr").find(".line-qty").val(0);
                        // clone.closest("tr").find(".line-product-warehouse-id").val(selecteditem[i]['warehouse_id']);
                        // clone.closest("tr").find(".line-product-warehouse-name").val(selecteditem[i]['warehouse_name']);
                        clone.closest("tr").find(".line-price").val(selecteditem[i]['price']);
                        clone.closest("tr").find(".line-product-unit-id").val(selecteditem[i]['unit_id']);
                        clone.closest("tr").find(".line-product-unit-name").val(selecteditem[i]['unit_name']);
                        clone.closest("tr").find(".line-photo").val("");
                        clone.closest("tr").find(".line-photo").attr("id",(parseInt(last_line_photo_id) +1));
                        
                        if(selecteditem[i]['is_drummy'] == 1){
                            clone.closest("tr").find(".line-product-name").prop("readonly", "");
                        }else{
                            clone.closest("tr").find(".line-product-name").prop("readonly", "readonly");
                        }
                        tr.after(clone);
                    } 
             }
                
          
        }
        
        $("#table-list tbody tr").each(function () {
           linenum += 1;
            $(this).closest("tr").find("td:eq(0)").text(linenum);
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
});

JS;

$this->registerJs($js,static::POS_END);

?>