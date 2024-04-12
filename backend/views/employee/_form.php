<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

$company_id = 1;
$branch_id = 1;
if (!empty(\Yii::$app->user->identity->company_id)) {
    $company_id = \Yii::$app->user->identity->company_id;
}
if (!empty(\Yii::$app->user->identity->branch_id)) {
    $branch_id = \Yii::$app->user->identity->branch_id;
}

$drivingcard_data = \backend\helpers\DrivingcardType::asArrayObject();

?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <input type="hidden" class="remove-list" name="remove_list" value="">
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'gender')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\helpers\GenderType::asArrayObject(), 'id', 'name'),
                'options' => [
                    'placeholder' => '--เลือกเพศ--'
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'position')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Position::find()->where(['company_id' => $company_id])->all(), 'id', 'name'),
                'options' => [
                    'placeholder' => '--เลือกตำแหน่ง--'
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'salary_type')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\helpers\SalaryType::asArrayObject(), 'id', 'name'),
                'options' => [
                    'placeholder' => '--เลือกประเภทเงินเดือน--'
                ]
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'company_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Company::find()->all(), 'id', 'name'),
                'options' => [
                    'placeholder' => '--เลือก--',
                ]
            ]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'cost_living_price')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'social_price')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?php echo $form->field($model, 'is_cashier')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>
        </div>
    </div>

    <br>
    <h5 style="color: blue;"><b>ข้อมูลบัตรประชาชน</b></h5>
    <div class="row">
        <div class="col-lg-3"><?= $form->field($model, 'id_card_no')->textinput(['maxlength' => true]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'card_issue_place')->textinput(['maxlength' => true]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'card_issue_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('d/m/Y'),
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'card_exp_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('d/m/Y'),
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]) ?></div>
    </div>
    <br>
    <h5 style="color: blue;"><b>ข้อมูลหนังสือเดินทาง</b></h5>
    <div class="row">
        <div class="col-lg-3"><?= $form->field($model, 'passport')->textinput(['maxlength' => true]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'passport_issue_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('d/m/Y'),
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'passport_exp_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('d/m/Y'),
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]) ?></div>
    </div>
    <br>
    <div class="row">

        <div class="col-lg-4">
            <?= $form->field($model, 'emp_start')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('d/m/Y'),
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-4">
            <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>

        </div>
    </div>


    <div class="row">
        <div class="col-lg-6">
            <br>
            <?php if ($model->photo != ''): ?>
                <div class="row">

                    <div class="col-lg-4">
                        <img src="../web/uploads/images/employee/<?= $model->photo ?>" width="100%" alt="">
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="btn btn-danger btn-delete-photo" data-var="<?= $model->id ?>">ลบรูปภาพ</div>
                    </div>
                    <div class="col-lg-4"></div>
                </div>
            <?php else: ?>
                <div class="row">

                    <div class="col-lg-4">
                        <?= $form->field($model, 'photo')->fileInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <br>

    <div class="row" id="div-1">
        <div class="col-lg-12">
            <table class="table table-bordered table-striped" id="table-list">
                <thead>
                <tr>
                    <th>ประเภทใบขับขี่</th>
                    <th>เลขที่ใบขับขี่</th>
                    <th>วันเริ่มต้น</th>
                    <th>วันหมดอายุ</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php if ($model->isNewRecord) : ?>
                    <tr>
                        <td>
                            <select name="card_type[]" class="form-control card-type" id="card-type" onchange="">
                                <option value="0">--ประเภท--</option>
                                <?php for ($i = 0; $i <= count($drivingcard_data) - 1; $i++) : ?>
                                    <option value="<?= $drivingcard_data[$i]['id'] ?>"><?= $drivingcard_data[$i]['name'] ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control card-no" name="card_no[]">
                        </td>
                        <td>
<!--                            <input type="text" class="form-control start-date" name="start_date[]">-->
                            <?php
                            echo DatePicker::widget([
                                'name' => 'start_date[]',
//                                                'id' => 'line-dp',
                                'options' => [
                                    'id' => 'start-date',
                                ],
                                'type' => DatePicker::TYPE_INPUT,
                                'value' => '',
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-mm-yyyy'
                                ],
                            ]);
                            ?>
                        </td>
                        <td>
<!--                            <input type="text" class="form-control expire-date" name="expire_date[]">-->
                            <?php
                            echo DatePicker::widget([
                                'name' => 'expire_date[]',
//                                                'id' => 'line-dp',
                                'options' => [
                                    'id' => 'expire-date',
                                ],
                                'type' => DatePicker::TYPE_INPUT,
                                'value' => '',
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-mm-yyyy'
                                ],
                            ]);
                            ?>
                        </td>
                        <td>
                            <div class="btn btn-danger btn-sm" onclick="removeline($(this))"><i
                                        class="fa fa-trash"></i></div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php if (count($model_line) > 0): ?>
                        <?php foreach ($model_line as $value): ?>
                        <tr data-var="<?= $value->id ?>">
                            <td>
                                <input type="hidden" class="rec-id" name="rec_id[]" value="<?= $value->id ?>">
                                <select name="card_type[]" class="form-control card-type" id="card-type" onchange="">
                                    <option value="0">--ประเภท--</option>
                                    <?php for ($i = 0; $i <= count($drivingcard_data) - 1; $i++) : ?>
                                        <?php
                                        $selected = '';
                                        if ($drivingcard_data[$i]['id'] == $value->license_type_id) {
                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option value="<?= $drivingcard_data[$i]['id'] ?>" <?= $selected ?>><?= $drivingcard_data[$i]['name'] ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control card-no" name="card_no[]"
                                value="<?=$value->license_no ?>">
                            </td>
                            <td value="">
                                <!--                            <input type="text" class="form-control start-date" name="start_date[]">-->
                                <?php
                                echo DatePicker::widget([
                                    'name' => 'start_date[]',
//                                                'id' => 'line-dp',
                                    'options' => [
                                        'id' => 'start-date',
                                    ],
                                    'type' => DatePicker::TYPE_INPUT,
                                    'value' => date('d-m-Y',strtotime($value->issue_date)),
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy'
                                    ],
                                ]);
                                ?>
                            </td>
                            <td>
                                <!--                            <input type="text" class="form-control expire-date" name="expire_date[]">-->
                                <?php
                                echo DatePicker::widget([
                                    'name' => 'expire_date[]',
//                                                'id' => 'line-dp',
                                    'options' => [
                                        'id' => 'expire-date',
                                    ],
                                    'type' => DatePicker::TYPE_INPUT,
                                    'value' => date('d-m-Y',strtotime($value->expired_date)),
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy'
                                    ],
                                ]);
                                ?>
                            </td>
                            <td>
                                <div class="btn btn-danger btn-sm" onclick="removeline($(this))"><i
                                            class="fa fa-trash"></i></div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td>
                                <select name="card_type[]" class="form-control card-type" id="card-type" onchange="">
                                    <option value="0">--ประเภท--</option>
                                    <?php for ($i = 0; $i <= count($drivingcard_data) - 1; $i++) : ?>
                                        <option value="<?= $drivingcard_data[$i]['id'] ?>"><?= $drivingcard_data[$i]['name'] ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control card-no" name="card_no[]">
                            </td>
                            <td>
                                <!--                            <input type="text" class="form-control start-date" name="start_date[]">-->
                                <?php
                                echo DatePicker::widget([
                                    'name' => 'start_date[]',
//                                                'id' => 'line-dp',
                                    'options' => [
                                        'id' => 'start-date',
                                    ],
                                    'type' => DatePicker::TYPE_INPUT,
                                    'value' => '',
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy'
                                    ],
                                ]);
                                ?>
                            </td>
                            <td>
                                <!--                            <input type="text" class="form-control expire-date" name="expire_date[]">-->
                                <?php
                                echo DatePicker::widget([
                                    'name' => 'expire_date[]',
//                                                'id' => 'line-dp',
                                    'options' => [
                                        'id' => 'expire-date',
                                    ],
                                    'type' => DatePicker::TYPE_INPUT,
                                    'value' => '',
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy'
                                    ],
                                ]);
                                ?>
                            </td>
                            <td>
                                <div class="btn btn-danger btn-sm" onclick="removeline($(this))"><i
                                            class="fa fa-trash"></i></div>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4">
                        <div class="btn btn-primary"
                             onclick="addline($(this))">
                            <i class="fa fa-plus-circle"></i>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <br>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<form id="form-delete-photo" action="<?= \yii\helpers\Url::to(['employee/deletephoto'], true) ?>" method="post">
    <input type="hidden" class="delete-photo-id" name="delete_id" value="">
</form>
<?php

$js = <<<JS
var removelist = [];

$(function(){
    // $('.start-date').datepicker({dateformat: 'dd-mm-yy'});
    // $('.expire-date').datepicker({dateFormat: 'dd-mm-yy'});
});
$(".btn-delete-photo").click(function (){
        var prodid = $(this).attr('data-var');
       //alert(prodid);
      swal({
                title: "ต้องการทำรายการนี้ใช่หรือไม่",
                text: "",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: true,
                showLoaderOnConfirm: true
               }, function () {
                  $(".delete-photo-id").val(prodid);
                  $("#form-delete-photo").submit();
         });
     });

function addline(e){
    var tr = $("#table-list tbody tr:last");
                    var clone = tr.clone();
                    //clone.find(":text").val("");
                    // clone.find("td:eq(1)").text("");
                    clone.find(".card-type").val("");
                    clone.find(".card-no").val("");
                    clone.find(".start-date").val("");
                    clone.find(".expire-date").val("");
                  
                    clone.attr("data-var", "");
                    clone.find('.rec-id').val("");
                    
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
                    $(this).find(".line-price").val(0);
                    // cal_num();
                });
            } else {
                e.parent().parent().remove();
            }
            // cal_linenum();
            // cal_all();
        }
    }

JS;

$this->registerJs($js, static::POS_END);

?>
