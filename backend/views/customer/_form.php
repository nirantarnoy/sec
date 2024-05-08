<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Customer $model */
/** @var yii\widgets\ActiveForm $form */

$address_chk = \backend\models\AddressInfo::find()->where(['party_id' => $model->id])->one();

$district_data = \backend\models\District::find()->all();
$city_data = \backend\models\Amphur::find()->all();
$province_data = \backend\models\Province::find()->all();
$district_chk = \backend\models\AddressInfo::findDistrictId($model->id);
$city_chk = \backend\models\AddressInfo::findAmphurId($model->id);
$province_chk = \backend\models\AddressInfo::findProvinceId($model->id);

$partycat_data = \backend\helpers\PartycatType::asArrayObject();
//$partycat_chk1 = \backend\models\AddressInfo::find()->where(['party_id' => $model->id])->one();

$contactcat_data = \backend\helpers\ContactcatType::asArrayObject();

$x_address = $address_chk == null ? '' : $address_chk->address;
$x_street = $address_chk == null ? '' : $address_chk->street;
$x_zipcode = $address_chk == null ? '' : $address_chk->zipcode;

$group_assign_list = [];
if($model_user_group_list!=null){
    foreach ($model_user_group_list as $value){
        array_push($group_assign_list,$value->group_id);
    }
}

//print_r($address_chk) ; return;
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>
    <input type="hidden" class="remove-list" name="remove_list" value="">

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'taxid')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?php $model->customer_group_id = $group_assign_list;?>
            <?= $form->field($model, 'customer_group_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Customergroup::find()->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'placeholder' => '--กลุ่มลูกค้า--'
                ],
                'pluginOptions' => [
                    'multiple' => true,
                ]
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">

            <?= $form->field($model, 'payment_term_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Paymentterm::find()->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'placeholder' => '--เลือกเงื่อนไขชำระเงิน--'
                ]
            ]) ?>

        </div>
        <div class="col-lg-3">

            <?= $form->field($model, 'payment_method_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Paymentmethod::find()->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'placeholder' => '--เลือกวิธีชำระเงิน--'
                ]
            ]) ?>

        </div>

    </div>

    <div class="row">
        <div class="col-lg-4">
            <label for="">ที่อยู่</label>
            <input type="text" class="form-control cus-address" id="cus-address"
                   value="<?= $model->isNewRecord ? '' : $x_address ?>" name="cus_address">
        </div>
        <div class="col-lg-4">
            <label for="">ถนน</label>
            <input type="text" class="form-control cus-street" id="cus-street"
                   value="<?= $model->isNewRecord ? '' : $x_street ?>" name="cus_street">
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-lg-3">
            <label for="">จังหวัด</label>
            <select name="province_id" class="form-control province-id" id=""
                    onchange="getCity($(this))">
                <option value="0">--จังหวัด--</option>
                <?php foreach ($province_data as $val3): ?>
                    <?php
                    $selected = '';
                    if ($val3->PROVINCE_ID == $province_chk)
                        $selected = 'selected';
//                    ?>
                    <option value="<?= $val3->PROVINCE_ID ?>" <?= $selected ?>><?= $val3->PROVINCE_NAME ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-lg-3">
            <label for="">อำเภอ/เขต</label>
            <select name="city_id" class="form-control city-id" id="city"
                    onchange="getDistrict($(this))">
                <option value="0">--อำเภอ/เขต--</option>
                <?php foreach ($city_data as $val2): ?>
                    <?php
                    $selected = '';
                    if ($val2->AMPHUR_ID == $city_chk)
                        $selected = 'selected';
//                    ?>
                    <option value="<?= $val2->AMPHUR_ID ?>" <?= $selected ?>><?= $val2->AMPHUR_NAME ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-lg-3">
            <label for="">ตำบล/แขวง</label>
            <select name="district_id" class="form-control district-id" id="district"
                    onchange="">
                <option value="0">--ตำบล/แขวง--</option>
                <?php foreach ($district_data as $val): ?>
                    <?php
                    $selected = '';
                    if ($val->DISTRICT_ID == $district_chk)
                        $selected = 'selected';
//                    ?>
                    <option value="<?= $val->DISTRICT_ID ?>" <?= $selected ?>><?= $val->DISTRICT_NAME ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-lg-3">
            <label for="">รหัสไปรษณีย์</label>
            <input type="text" class="form-control zipcode" id="zipcode"
                   value="<?= $model->isNewRecord ? '' : $x_zipcode ?>" name="zipcode" readonly>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'address')->textarea(['maxlength' => true]) ?>
        </div>
    </div>

    <!--    <? //= $form->field($model, 'status')->textInput() ?>-->
    <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>

<?php
$url_to_getcity = \yii\helpers\Url::to(['customer/showcity'], true);
$url_to_getdistrict = \yii\helpers\Url::to(['customer/showdistrict'], true);
$url_to_getzipcode = \yii\helpers\Url::to(['customer/showzipcode'], true);
$url_to_getAddress = \yii\helpers\Url::to(['customer/showaddress'], true);

$js = <<<JS
var removelist = [];

$(function(){
    
});
function addline(e){
    var tr = $("#table-list tbody tr:last");
                    var clone = tr.clone();
                    //clone.find(":text").val("");
                    // clone.find("td:eq(1)").text("");
                    clone.find(".line-name").val("");
                    clone.find(".line-type-id").val("");
                    clone.find(".line-contact-no").val("");
                  
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
function getCity(e){
    $.post("$url_to_getcity"+"&id="+e.val(),function(data){
        $("select#city").html(data);
        $("select#city").prop("disabled","");
    });
}

function getDistrict(e){
    $.post("$url_to_getdistrict"+"&id="+e.val(),function(data){
                                          $("select#district").html(data);
                                          $("select#district").prop("disabled","");

                                        });
                                           $.post("$url_to_getzipcode"+"&id="+e.val(),function(data){
                                                $("#zipcode").val(data);
                                              });
}

function getAddres(e){
    $.post("$url_to_getAddress"+"&id="+e.val(),function(data){
        $("#city").html(data);
        $("select#city").prop("disabled","");
    });
}

JS;
$this->registerJs($js, static::POS_END);
?>

