<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Advancetable $model */
/** @var yii\widgets\ActiveForm $form */
$model_table_line = \common\models\CashAdvance::find()->where(['advance_master_id' => $model->id])->orderBy(['trans_date' => SORT_DESC])->all();
?>

    <div class="advancetable-form">

        <?php $form = ActiveForm::begin(['id' => 'form-advancetable']); ?>
        <?= $form->field($model, 'trans_month')->hiddenInput(['readonly' => 'readonly', 'value' => (int)date('m')])->label(false) ?>
        <div class="row">
            <div class="col-lg-2">
                <?= $form->field($model, 'trans_year')->textInput(['readonly' => 'readonly', 'value' => (int)date('Y')]) ?>
            </div>
            <div class="col-lg-3">
                <label for="">เดือน</label>
                <input type="text" class="form-control"
                       value="<?= \backend\helpers\MonthData::getTypeById((int)date('m')) ?>"
                       readonly="readonly">
            </div>
            <div class="col-lg-4">
                <label for="">ทีม</label>
                <input type="text" class="form-control" value="<?= \backend\models\Team::findName(1) ?>"
                       readonly="readonly">
                <?= $form->field($model, 'team_id')->hiddenInput(['value' => 1])->label(false) ?>
            </div>
            <!--        <div class="col-lg-3">-->
            <!--            --><?php //= $form->field($model, 'advance_amount')->textInput(['value' => $model->isNewRecord ?0:$model->advance_amount]) ?>
            <!--        </div>-->
            <div class="col-lg-3">
                <?= $form->field($model, 'total_balance')->textInput(['readonly' => 'readonly', 'value' => $model->isNewRecord ? 0 : $model->total_balance]) ?>
            </div>
        </div>
        <br/>

        <?php if (!$model->isNewRecord): ?>
            <?php $model_table_line = \common\models\CashAdvance::find()->where(['advance_master_id' => $model->id])->all(); ?>
            <?= $form->field($model_line, 'advance_master_id')->hiddenInput(['value' => $model->id])->label(false) ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <b><h4>รายการรับจ่าย</h4></b>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-3">
                    <?php $model_line->trans_date = date('d-m-Y'); ?>
                    <?= $form->field($model_line, 'trans_date')->widget(\kartik\date\DatePicker::className(), [
                        'pluginOptions' => [
                            'format' => 'dd-mm-yyyy',
                            'todayHighlight' => true
                        ]
                    ]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model_line, 'trans_type_id')->widget(\kartik\select2\Select2::className(), [
                        'options' => [
                            'id' => 'trans-type-id',
                            'placeholder' => 'เลือกประเภท',
                            'onchange' => 'changeTransType($(this));'
                        ],
                        'data' => \yii\helpers\ArrayHelper::map(\backend\helpers\CashAdvanceType::asArrayObject(), 'id', 'name'),
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ]); ?>
                    <div class="trans-type-id-validate" style="display:none;color:red;">เลือกประเภทรายการ</div>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model_line, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model_line, 'in_amount')->textInput(['id'=>'in-amount','type' => 'number', 'value' => 0, 'step' => 'any']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model_line, 'out_amount')->textInput(['id'=>'out-amount','type' => 'number', 'value' => 0, 'step' => 'any']) ?>
                </div>

                <div class="col-lg-3">
                    <label for="">ใบเสนอราคาเลขที่ / Quotation No.</label>
                    <br/>
                    <!-- Input Field -->
                    <?= Html::textInput('tagInput', '', [
                        'class' => 'tag-input',
                        'id' => 'tagInput',
                        'placeholder' => 'Type and press space...',
                        'style' => 'width: 100%; padding: 5px;'
                    ]) ?>

                    <!-- Hidden Field to Store Tags (For Form Submission) -->
                    <?php echo Html::hiddenInput('quotation_tags', '', ['id' => 'hiddenTags']) ?>
                    <?php //echo $form->field($model_line, 'quotation_ref_no')->textInput(['maxlength' => true,'id'=>'hiddenTags']) ?>
                    <div class="tag-validate" style="display:none;color:red;">กรอกข้อมูลเลขที่ใบเสนอราคา</div>

                </div>
                <div class="col-lg-6">
                    <?= $form->field($model_line, 'customer_id')->widget(\kartik\select2\Select2::className(), [
                        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Customer::find()->where(['status' => 1])->orderBy(['can_new' => SORT_ASC])->all(), 'id', 'name'),
                        'options' => [
                            'id' => 'selected-customer-id',
                            'placeholder' => 'เลือกลูกค้า...',
                            'onchange' => 'checkcreateNew($(this));',
                        ],
                        'pluginOptions' => ['allowClear' => true],
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model_line, 'distance_total')->textInput(['type' => 'number', 'value' => 0, 'class' => 'form-control distance-value', 'onchange' => 'calculateTotal($(this));']) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model_line, 'express_amount')->textInput(['type' => 'number', 'value' => 0, 'class' => 'form-control express-value', 'onchange' => 'calculateTotal($(this));']) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model_line, 'line_total')->textInput(['readonly' => 'readonly', 'class' => 'form-control total-value']) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model_line, 'remark')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <?php if (!$model->isNewRecord): ?>
                        <div class="form-group">
                            <?php //echo Html::submitButton('เพิ่มรายการในตาราง', ['class' => 'btn btn-primary']) ?>
                            <div class="btn btn-primary" onclick="submitformadvance();">เพิ่มรายการในตาราง</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <br/>
            <div class="row">
                <div class="col-lg-12">
                    <div style="overflow: scroll;">
                        <table class="table table-bordered" style="width: 100%">
                            <thead>
                            <tr>
                                <th style="background-color: lightgreen;text-align: center;width: 10%">วันที่</th>
                                <th style="background-color: lightgreen;width: 15%;">รายการ</th>
                                <th style="text-align: right;background-color: lightgreen;">รับ</th>
                                <th style="text-align: right;background-color: lightgreen;">จ่าย</th>
                                <th style="text-align: right;background-color: lightgreen;">คงเหลือ</th>
                                <th style="background-color: lightgreen;">เลขที่ใบเสนอราคา</th>
                                <th style="background-color: lightgreen;">ชื่อลูกค้า</th>
                                <th style="text-align: right;background-color: lightgreen;">ระยะทางรวม</th>
                                <th style="text-align: right;background-color: lightgreen;">ค่าทางด่วน</th>
                                <th style="text-align: right;background-color: lightgreen;">รวม</th>
                                <th style="background-color: lightgreen;">หมายเหตุ</th>
                                <th style="width: 5%;background-color: lightgreen"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($model_table_line != null): ?>
                                <?php foreach ($model_table_line as $line): ?>
                                    <tr data-var="<?= $line->id; ?>">
                                        <td style="text-align: center;"><?= date('d-m-Y', strtotime($line->trans_date)) ?></td>
                                        <td><?= $line->name ?></td>
                                        <td style="text-align: right;color: green;"><?= number_format($line->in_amount, 2) ?></td>
                                        <td style="text-align: right;color: red;"><?= number_format($line->out_amount, 2) ?></td>
                                        <td style="text-align: right;background-color: lightgrey;"><?= number_format($line->balance_amount, 2) ?></td>
                                        <td><?= $line->quotation_ref_no ?></td>
                                        <td><?= \backend\models\Customer::findCusName($line->customer_id); ?></td>
                                        <td style="text-align: right;"><?= $line->distance_total ?></td>
                                        <td style="text-align: right;"><?= $line->express_amount ?></td>
                                        <td style="text-align: right;background-color: lightgrey;"><?= number_format($line->line_total, 2) ?></td>
                                        <td><?= $line->remark ?></td>
                                        <td style="text-align: center;">
                                            <div class="btn btn-sm btn-danger" onclick="removeline($(this))">ลบ</div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        <?php endif; ?>

        <?php if ($model->isNewRecord): ?>
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        <?php endif; ?>

        <?php ActiveForm::end(); ?>

    </div>


    <div id="createCustomerModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>สร้างข้อมูลลูกค้า</h3>
                </div>
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">-->
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto;scrollbar-x-position: top">-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">ชื่อ</label>
                            <input type="text" class="form-control new-customer-name" name="new_customer_name"
                                   required value="" onchange="checkvalidateinput($(this))">
                            <div class="name-validate" style="display:none;color:red;">กรอกข้อมูลชื่อก่อน</div>

                        </div>

                    </div>
                    <div style="height: 10px;"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">รายละเอียด</label>
                            <textarea name="new_customer_description" class="form-control new-customer-description"
                                      id="" cols="30" rows="3"></textarea>
                        </div>
                    </div>

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
$url_to_delete_cash_advance = \yii\helpers\Url::to(['advancetable/deletecashadvance'], true);
$url_to_create_customer = \yii\helpers\Url::to(['advancetable/createcustomer'], true);

$js = <<<JS
$(function(){
   // var tags = $("#hiddenTags").val();
     let tags = [];
    $('#selected-customer-id').on('select2:open', function() {
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
    
    
    $('#tagInput').on('keyup', function(event) {
        let input = $(this);
        let value = input.val().trim();

        // If space or enter is pressed
        if ((event.which === 32 || event.which === 13) && value !== '') {
            // Prevent form submission on Enter
            event.preventDefault();
            
            
            // var xx = checkdupQuotation(value);
            // alert(xx);
            
          
            // Check if tag already exists
            if (!tags.includes(value)) {
                tags.push(value); // Add to tag list

                // Create tag element
                let tag = $('<span class="tag-item">' + value + ' <span class="remove-tag" style="cursor:pointer;color:red;">✖</span></span>');
                tag.css({
                    'display': 'inline-block',
                    'background': '#007bff',
                    'color': 'white',
                    'padding': '5px 10px',
                    'margin': '5px',
                    'border-radius': '5px'
                });

                // Insert the tag before input
                input.before(tag);
                
                // Update hidden field value (for form submission)
                $('#hiddenTags').val(tags.join(','));

                // Clear input for next tag
                input.val('');

                // Remove tag when clicking "✖"
                tag.find('.remove-tag').click(function() {
                    let text = $(this).parent().text().trim().slice(0, -1); // Remove '✖' character
                    tags = tags.filter(t => t !== text); // Remove from array
                    $('#hiddenTags').val(tags.join(',')); // Update hidden field
                    $(this).parent().remove(); // Remove tag element
                });
            } else {
                input.val(''); // Clear duplicate entry
            }
            
            if(tags.length > 0){
                $(".tag-validate").hide();
            }
        }
    });
});
function removeline(e){
    var line_id = e.parent().parent().attr("data-var");
    if(line_id != null){
        if(confirm("ต้องการลบข้อมูลใช่หรือไม่?")){
            $.ajax({
                url: '$url_to_delete_cash_advance',
                type: 'POST',
                dataType: 'html',
                data: {'line_id': line_id},
                success: function (data) {
                    window.location.reload();
                    // alert(data);
                },
                error: function (err) {
                    
                }
            });
        }
    }
 }
 function createnewdistributor(){
    var customer_name = $(".new-customer-name").val();
    var customer_desc = $(".new-customer-description").val();
   // alert(unit_name);
    if(customer_name == ''){
        $(".new-customer-name").css(["border-color", "red"]);
        $(".name-validate").show();
        return false;
    }else{
        $(".name-validate").hide();
        $.ajax({
            url: '$url_to_create_customer',
            dataType: 'html',
            method: 'POST',
            data: {
                'name': customer_name,
                'description': customer_desc,
            },
            success: function (data) {
                $(".new-customer-name").val('');
                $(".new-customer-description").val('');
                $("#createCustomerModal").modal("hide");
                // $("#selected-unit-id").append('<option value="'+data+'">'+unit_name+'</option>');
                // $("#selected-unit-id").val(data).change();
                if(data != '' || data != null){
                     $("#selected-customer-id").html(data);
                }
               
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}

function checkcreateNew(e){
    var text = $("#selected-customer-id option:selected").text().trim();
   
    if (text == 'Create New') { // Change background for ID = 1
        $(e).css("background-color", "#28a745"); // Green
        $(e).css("color", "white"); // White text for better contrast
       
        $("#createCustomerModal").modal("show");
    }
}

function checkvalidateinput(e){
    var new_name = $(".new-customer-name").val();
    if(new_name == ''){
        $(".name-validate").show();
    }else{
        $(".name-validate").hide();
    }
}
function calculateTotal(e){
    var total = 0;
    var distance_val = $(".distance-value").val();
    var express_val = $(".express-value").val();
    if(distance_val != '' && express_val != ''){
        total = parseFloat(distance_val) * parseFloat(express_val);
    }
    
    $(".total-value").val(parseFloat(total).toFixed(2));
}
function submitformadvance(){
    var form = $("form#form-advancetable");
    var tag_check = $("#hiddenTags").val();
    var trans_type_id = $("#trans-type-id").val();
    //alert(trans_type_id);
    if(trans_type_id >=3){
        $(".trans-type-id-validate").hide();
        if(tag_check == '' || tag_check == null){
            $(".tag-validate").show();
            return false;
        }else{
            $(".tag-validate").hide();
            form.submit();
        }
    }
    if(trans_type_id !=null && trans_type_id !=''){
         form.submit();
    }else{
        $(".trans-type-id-validate").show();
    }
}

function changeTransType(e){
    var value = e.val();
     $(".tag-validate").hide();
     if(value !=null || value !=''){
         $(".trans-type-id-validate").hide();
     }
    if(value == '1'){
        $("#in-amount").prop("disabled","");
        $("#out-amount").prop("disabled","disabled");
        $(".distance-value").prop("disabled","disabled");
        $(".express-value").prop("disabled","disabled");
        $("#tagInput").prop("disabled","disabled");
    }else if(value == '2'){
        $("#in-amount").prop("disabled","");
        $("#out-amount").prop("disabled","disabled");
        $(".distance-value").prop("disabled","disabled");
        $(".express-value").prop("disabled","disabled");
        $("#tagInput").prop("disabled","disabled");
    }else if(value == '3'){
        $("#in-amount").prop("disabled","disabled");
        $("#out-amount").prop("disabled","");
        $(".distance-value").prop("disabled","");
        $(".express-value").prop("disabled","");
        $("#tagInput").prop("disabled","");
    }else if(value == '4'){
        $("#in-amount").prop("disabled","disabled");
        $("#out-amount").prop("disabled","");
        $(".distance-value").prop("disabled","");
        $(".express-value").prop("disabled","");
        $("#tagInput").prop("disabled","");
    }else if(value == '5'){
        $("#in-amount").prop("disabled","disabled");
        $("#out-amount").prop("disabled","");
        $(".distance-value").prop("disabled","");
        $(".express-value").prop("disabled","");
        $("#tagInput").prop("disabled","");
    }
}
JS;

$this->registerJs($js, static::POS_END);
?>