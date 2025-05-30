<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
$data_warehouse = \backend\models\Warehouse::find()->all();
$data_customer = \backend\models\Customer::find()->all();

$yesno = [['id' => 1, 'YES'], ['id' => 0, 'NO']];
?>

    <div class="product-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <input type="hidden" class="remove-list" name="remove_list" value="">
        <input type="hidden" class="remove-customer-list" name="remove_customer_list" value="">
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'product_cat_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Productgroup::find()->all(), 'id', 'name'),
                    'options' => [

                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'unit_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => ArrayHelper::map(\backend\models\Unit::find()->orderBy(['can_new'=>SORT_ASC])->all(), 'id', 'name'),
                    'options' => [
                        'id'=>'selected-unit-id',
                        'placeholder' => '-- เลือกหน่วยนับ --',
                        'onchange'=>'checkcreateNew($(this));'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'cal_type_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\CostCalType::find()->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => '-- เลือกประเภทการคำนวน --',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'distributor_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Distributor::find()->where(['status'=>1])->orderBy(['can_new'=>SORT_ASC])->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => '-- เลือกผู้นำเข้าหลัก --',
                        'id'=>'selected-distributor-id',
                        'onchange'=>'checkcreateNewDistributor($(this));'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-3">
                <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>
            </div>
            <div class="col-lg-3"></div>
        </div>
        <br/>
        <!--    <div class="row">-->
        <!--        <div class="col-lg-6">-->
        <!--            <label for="">รูปภาพ</label>-->
        <!--            --><?php //if ($model->isNewRecord): ?>
        <!--                <table style="width: 100%">-->
        <!--                    <tr>-->
        <!--                        <td style="border: 1px dashed grey;height: 250px;text-align: center;">-->
        <!--                            <i class="fa fa-ban fa-lg" style="color: grey"></i>-->
        <!--                            <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>-->
        <!--                        </td>-->
        <!--                    </tr>-->
        <!--                </table>-->
        <!--            --><?php //else: ?>
        <!--                <table style="width: 100%">-->
        <!--                    <tr>-->
        <!--                        --><?php //if ($model->photo != ''): ?>
        <!--                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">-->
        <!--                                <a href="-->
        <?php //= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo ?><!--"-->
        <!--                                   target="_blank"><img-->
        <!--                                            src="-->
        <?php //= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo ?><!--"-->
        <!--                                            style="max-width: 130px;margin-top: 5px;" alt=""></a>-->
        <!--                            </td>-->
        <!--                        --><?php //else: ?>
        <!--                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">-->
        <!--                                <i class="fa fa-ban fa-lg" style="color: grey"></i>-->
        <!--                                <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>-->
        <!--                            </td>-->
        <!--                        --><?php //endif; ?>
        <!--                    </tr>-->
        <!--                </table>-->
        <!--            --><?php //endif; ?>
        <!--            <input type="file" name="product_photo" class="form-control">-->
        <!--        </div>-->
        <!--        <div class="col-lg-6">-->
        <!--            <label for="">รูปภาพ</label>-->
        <!--            --><?php //if ($model->isNewRecord): ?>
        <!--                <table style="width: 100%">-->
        <!--                    <tr>-->
        <!--                        <td style="border: 1px dashed grey;height: 250px;text-align: center;">-->
        <!--                            <i class="fa fa-ban fa-lg" style="color: grey"></i>-->
        <!--                            <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>-->
        <!--                        </td>-->
        <!--                    </tr>-->
        <!--                </table>-->
        <!--            --><?php //else: ?>
        <!--                <table style="width: 100%">-->
        <!--                    <tr>-->
        <!--                        --><?php //if ($model->photo_2 != ''): ?>
        <!--                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">-->
        <!--                                <a href="-->
        <?php //= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo_2 ?><!--"-->
        <!--                                   target="_blank"><img-->
        <!--                                            src="-->
        <?php //= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo_2 ?><!--"-->
        <!--                                            style="max-width: 130px;margin-top: 5px;" alt=""></a>-->
        <!--                            </td>-->
        <!--                        --><?php //else: ?>
        <!--                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">-->
        <!--                                <i class="fa fa-ban fa-lg" style="color: grey"></i>-->
        <!--                                <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>-->
        <!--                            </td>-->
        <!--                        --><?php //endif; ?>
        <!--                    </tr>-->
        <!--                </table>-->
        <!--            --><?php //endif; ?>
        <!--            <input type="file" name="product_photo_2" class="form-control">-->
        <!--        </div>-->
        <!---->
        <!--    </div>-->
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <h4>จัดการสต๊อกสินค้า</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-striped" id="table-list">
                    <thead>
                    <tr>
                        <th style="text-align: center;">ที่จัดเก็บ</th>
                        <th style="text-align: center;">จำนวนคงเหลือ</th>
                        <th>-</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($model_line != null): ?>
                        <?php foreach ($model_line as $value): ?>
                            <tr data-var="<?= $value->id; ?>">
                                <td>
                                    <input type="hidden" class="form-control line-rec-id" name="line_rec_id[]"
                                           value="<?= $value->id ?>">
                                    <select name="warehouse_id[]" id="" class="form-control line-warehouse-id">
                                        <option value="-1">--เลือก-</option>
                                        <?php foreach ($data_warehouse as $xvalue): ?>
                                            <?php
                                            $selected = '';
                                            if ($value->warehouse_id == $xvalue->id) {
                                                $selected = 'selected';
                                            }
                                            ?>
                                            <option value="<?= $xvalue->id ?>" <?= $selected ?>><?= $xvalue->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control line-qty" name="line_qty[]"
                                           value="<?= $value->qty ?>">
                                </td>
                                <td>
                                    <div class="btn btn-danger" onclick="removeline($(this))"><i
                                                class="fa fa-trash"></i></div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr data-var="">
                            <td>
                                <!--                            <input type="text" class="form-control line-warehouse-id" name="warehouse_id[]" value="">-->
                                <input type="hidden" class="form-control line-rec-id" name="line_rec_id[]" value="0">
                                <select name="warehouse_id[]" id="" class="form-control line-warehouse-id">
                                    <option value="-1">--เลือก-</option>
                                    <?php foreach ($data_warehouse as $xvalue): ?>
                                        <option value="<?= $xvalue->id ?>"><?= $xvalue->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control line-qty" name="line_qty[]" value="">
                            </td>
                            <td>
                                <div class="btn btn-danger" onclick="removeline($(this))"><i class="fa fa-trash"></i>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: left;">
                            <div class="btn btn-sm btn-primary" onclick="addline($(this))">เพิ่ม</div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <br/>


        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


    <div id="createUnitModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>สร้างหน่วยนับ</h3>
                </div>
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">-->
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto;scrollbar-x-position: top">-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">ชื่อ</label>
                            <input type="text" class="form-control new-unit-name" name="new_unit_name" required value="">

                        </div>
                        <div class="col-lg-4">
                            <label for="">รายละเอียด</label>
                            <input type="text" class="form-control" name="new_unit_description" required value="">
                        </div>


                    </div>
                    <div style="height: 10px;"></div>

                    <br/>

                </div>
                <div class="modal-footer">
                    <div class="btn btn-outline-success btn-save-unit" onclick="createnewunit()"><i
                                class="fa fa-check"></i> บันทึก
                    </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                    </button>
                </div>
            </div>

        </div>
    </div>

    <div id="createDistributorModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>สร้างข้อมูลผู้นำเข้าหลัก</h3>
                </div>
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">-->
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto;scrollbar-x-position: top">-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">ชื่อ</label>
                            <input type="text" class="form-control new-distributor-name" name="new_distributor_name"
                                   required value="">

                        </div>
                        <div class="col-lg-4">
                            <label for="">รายละเอียด</label>
                            <input type="text" class="form-control" name="new_distributor_description" required
                                   value="">
                        </div>


                    </div>
                    <div style="height: 10px;"></div>

                    <br/>

                </div>
                <div class="modal-footer">
                    <div class="btn btn-outline-success btn-save-unit" onclick="createnewdistributor()"><i
                                class="fa fa-check"></i> บันทึก
                    </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                    </button>
                </div>
            </div>

        </div>
    </div>
<?php
$url_to_create_unit = Url::to(['product/createunit'], true);
$url_to_create_distributor = \yii\helpers\Url::to(['job/createdistributor'], true);
$js = <<<JS
var removelist = [];
var removecustomerpricelist = [];
$(function(){
  // $(".line-exp-date").datepicker(); 
  
  $('#selected-unit-id').on('select2:open', function() {
            setTimeout(function() {
                $(".select2-results__option").each(function() {
                    //var id = $(this).attr(""); // Get the option ID
                    
                    // if (id &&id.includes("9")) { // Change background for ID = 1
                    //     $(this).css("background-color", "#28a745"); // Green
                    //     $(this).css("color", "white"); // White text for better contrast
                    // }
                    
                    var text = $(this).text().trim();
                    
                      if (text === 'Create New') { // Change background for ID = 1
                        $(this).css("background-color", "#28a745"); // Green
                        $(this).css("color", "white"); // White text for better contrast
                        $(this).css("text-align","center");
                    }
                });
            }, 100);
    });
  
  $('#selected-distributor-id').on('select2:open', function() {
            setTimeout(function() {
                $(".select2-results__option").each(function() {
                    //var id = $(this).attr(""); // Get the option ID
                    
                    // if (id &&id.includes("9")) { // Change background for ID = 1
                    //     $(this).css("background-color", "#28a745"); // Green
                    //     $(this).css("color", "white"); // White text for better contrast
                    // }
                    
                    var text = $(this).text().trim();
                    
                      if (text === 'Create New') { // Change background for ID = 1
                        $(this).css("background-color", "#28a745"); // Green
                        $(this).css("color", "white"); // White text for better contrast
                        $(this).css("text-align","center");
                    }
                });
            }, 100);
    });
});

function checkcreateNewDistributor(e){
    var text = $("#selected-distributor-id option:selected").text().trim();
    //alert(text);
    if (text == 'Create New') { // Change background for ID = 1
        $(e).css("background-color", "#28a745"); // Green
        $(e).css("color", "white"); // White text for better contrast
        $(e).css("text-align","center");
        
        $("#createDistributorModal").modal("show");
    }
}
function addline(e){
    var tr = $("#table-list tbody tr:last");
    var clone = tr.clone();
                    //clone.find(":text").val("");
                    // clone.find("td:eq(1)").text("");
    clone.find(".line-warehouse-id").val("-1").change();
    clone.find(".line-qty").val("");
    clone.find(".line-exp-date").val("");
    clone.find(".line-rec-id").val("0");

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
                    $(this).find(".line-warehouse-id").val("-1").change();
                    $(this).find(".line-qty").val("");
                    $(this).find(".line-exp-date").val("");
                    $(this).find(".line-rec-id").val("0");
                });
            } else {
                e.parent().parent().remove();
            }
            // cal_linenum();
            // cal_all();
        }
}
function removecustomerpriceline(e) {
        if (confirm("ต้องการลบรายการนี้ใช่หรือไม่?")) {
            if (e.parent().parent().attr("data-var") != '') {
                removecustomerpricelist.push(e.parent().parent().attr("data-var"));
                $(".remove-customer-list").val(removecustomerpricelist);
            }
            // alert(removelist);
            // alert(e.parent().parent().attr("data-var"));

            if ($("#table-list2 tbody tr").length == 1) {
                $("#table-list2 tbody tr").each(function () {
                    $(this).find(":text").val("");
                    $(this).find(".line-product-customer-id").val("-1").change();
                    $(this).find(".line-customer-price").val("0");
                });
            } else {
                e.parent().parent().remove();
            }
            // cal_linenum();
            // cal_all();
        }
}
function addcustomerpriceline(e){
    var tr = $("#table-list2 tbody tr:last");
    var clone = tr.clone();
                    //clone.find(":text").val("");
                    // clone.find("td:eq(1)").text("");
    clone.find(".line-product-customer-id").val("-1").change();
    clone.find(".line-customer-price").val("0");

    tr.after(clone);
     
}

function checkcreateNew(e){
    var text = $("#selected-unit-id option:selected").text().trim();
    //alert(text);
    if (text == 'Create New') { // Change background for ID = 1
        $(e).css("background-color", "#28a745"); // Green
        $(e).css("color", "white"); // White text for better contrast
        
        $("#createUnitModal").modal("show");
    }
}

function createnewunit(){
    var unit_name = $(".new-unit-name").val();
    var unit_desc = $(".new-unit-description").val();
   // alert(unit_name);
    if(unit_name == ''){
        $(".new-unit-name").css(["border-color", "red"]);
        return false;
    }else{
        $.ajax({
            url: '$url_to_create_unit',
            dataType: 'html',
            method: 'POST',
            data: {
                'name': unit_name,
                'description': unit_desc,
            },
            success: function (data) {
                $("#createUnitModal").modal("hide");
                // $("#selected-unit-id").append('<option value="'+data+'">'+unit_name+'</option>');
                // $("#selected-unit-id").val(data).change();
                if(data != '' || data != null){
                     $("#selected-unit-id").html(data);
                }
               
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}

function createnewdistributor(){
    var unit_name = $(".new-distributor-name").val();
    var unit_desc = $(".new-distributor-description").val();
   // alert(unit_name);
    if(unit_name == ''){
        $(".new-distributor-name").css(["border-color", "red"]);
        return false;
    }else{
        $.ajax({
            url: '$url_to_create_distributor',
            dataType: 'html',
            method: 'POST',
            data: {
                'name': unit_name,
                'description': unit_desc,
            },
            success: function (data) {
                $("#createDistributorModal").modal("hide");
                // $("#selected-unit-id").append('<option value="'+data+'">'+unit_name+'</option>');
                // $("#selected-unit-id").val(data).change();
                if(data != '' || data != null){
                     $("#selected-distributor-id").html(data);
                }
               
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}


JS;
$this->registerJs($js, static::POS_END);
?>