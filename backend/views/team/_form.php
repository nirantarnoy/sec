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
    <input type="hidden" class="remove-list" name="removelist" value>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

            <?= $form->field($model, 'team_type_id')->widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\helpers\TeamType::asArrayObject(), 'id', 'name'),
                'options' => [
                    'placeholder' => '-- เลือกประเภท --'
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ]) ?>

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
                            <input type="text" class="form-control line-emp-name" name="line_emp_name[]" value="" readonly>
                        </td>
                        <td>
                            <select name="line_is_head[]" id="" class="form-control line-is-head">
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
                    <?php if($model_line!=null): ?>
                    <?php $line_num = 0;?>
                       <?php foreach ($model_line as $line): ?>
                        <?php $line_num++; ?>
                            <tr data-var="<?=$line->id?>">
                                <td style="text-align: center;"><?=$line_num?></td>
                                <td>
                                    <input type="hidden" class="line-emp-id" name="line_emp_id[]" value="<?=$line->emp_id?>">
                                    <input type="text" class="form-control line-emp-name" name="line_emp_name[]" value="<?=\backend\models\Employee::findFullName($line->emp_id)?>" readonly>
                                </td>
                                <td>
                                    <select name="line_is_head[]" id="" class="form-control line-is-head">
                                        <?php foreach ($yesno as $y): ?>
                                            <?php
                                              $selected = '';
                                              if($y['id'] == $line->is_head){
                                                  $selected = 'selected';
                                              }
                                            ?>
                                            <option value="<?= $y['id'] ?>" <?=$selected?>><?= $y['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td style="text-align: center">
                                    <div class="btn btn-sm btn-danger" onclick="removeline($(this))">ลบ</div>
                                </td>
                            </tr>
                       <?php endforeach;?>

                    <?php else:?>
                        <tr>
                            <td style="text-align: center;"></td>
                            <td>
                                <input type="hidden" class="line-emp-id" name="line_emp_id[]">
                                <input type="text" class="form-control line-emp-name" name="line_emp_name[]" value="" readonly>
                            </td>
                            <td>
                                <select name="line_is_head[]" id="" class="form-control line-is-head">
                                    <?php foreach ($yesno as $y): ?>
                                        <option value="<?= $y['id'] ?>"><?= $y['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td style="text-align: center">
                                <div class="btn btn-sm btn-danger" onclick="removeline($(this))">ลบ</div>
                            </td>
                        </tr>
                    <?php endif;?>
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
                    <h3>รายชื่อพนักงาน</h3>
                </div>
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">-->
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto;scrollbar-x-position: top">-->

                <div class="modal-body">
                    <input type="hidden" name="line_qc_product" class="line_qc_product" value="">
                    <table class="table table-bordered table-striped table-find-list" width="100%">
                        <thead>
                        <tr>
                            <th style="width:10%;text-align: center">เลือก</th>
                            <th style="width: 10%;text-align: center">รหัสพนักงาน</th>
                            <th style="width: 20%;text-align: center">ชื่อพนักงาน</th>
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
$url_to_find_item = \yii\helpers\Url::to(['team/finditem'], true);
$js = <<<JS
var selecteditem = [];
var removelist = [];
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
                       // $(this).find(".line-prod-photo").attr('src', '');
                        $(this).find(".line-is-head").val('0').change();
                        // cal_num();
                    });
                } else {
                    e.parent().parent().remove();
                }
                // cal_linenum();
                // cal_all();
                cal_all();
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
        var emp_id = e.closest('tr').find('.line-find-emp-id').val();
      
        ///// add new 
         var emp_name = e.closest('tr').find('.line-find-emp-name').val();
        ///////
        if (id) {
            if (checkhas(emp_id)){
                alert("รหัสพนักงานซ้ำ");
                return false;
            }
            if (e.hasClass('btn-outline-success')) {
                var obj = {};
                obj['emp_id'] = id;
                obj['emp_name'] = emp_name;
                
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

function checkhas(emp_id){
    var has = 0;
    $("#table-list tbody tr").each(function () {
       var id = $(this).closest("tr").find(".line-emp-id").val();
       if (id == emp_id ){
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
                   if (tr.closest("tr").find(".line-emp-id").val() == "") {
                  //  alert(line_prod_code);
            
                    tr.closest("tr").find(".line-emp-id").val(selecteditem[i]['emp_id']);
                    tr.closest("tr").find(".line-emp-name").val(selecteditem[i]['emp_name']);
                    
                    //console.log(line_prod_code);
                    } else {
                        var clone = tr.clone();
                        clone.closest("tr").find(".line-rec-id").val('0');
                        clone.closest("tr").find(".line-emp-id").val(selecteditem[i]['emp_id']);
                        clone.closest("tr").find(".line-emp-name").val(selecteditem[i]['emp_name']);
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