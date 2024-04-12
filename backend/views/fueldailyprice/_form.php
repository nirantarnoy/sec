<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Fueldailyprice $model */
/** @var yii\widgets\ActiveForm $form */

$province_data = \backend\models\Province::find()->all();
//$province_chk = \backend\models\AddressInfo::findProvinceShowname($model->province_id);
$city_data = \backend\models\Amphur::find()->all();
$cityzone_data = \common\models\Cityzone::find()->all();
//$city_chk = \backend\models\AddressInfo::findAmphurShowname($model->city_id);
?>

<div class="fueldailyprice-form">
    <?php if($model->isNewRecord):?>
    <div class="row">
        <div class="col-lg-3">
            <div class="btn btn-info btn-pull-price">ดึงราคาน้ำมัน (วันนี้)</div>
        </div>
    </div>
    <?php endif;?>
    <br/>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-3">
            <label for="">จังหวัด</label>
            <select name="province_id" class="form-control province-id" id=""
                    onchange="getCity($(this))">
                <option value="0">--จังหวัด--</option>
                <?php foreach ($province_data as $val3): ?>
                    <?php
                    $selected = '';
                    if ($val3->PROVINCE_ID == $model->province_id)
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
                    if ($val2->AMPHUR_ID == $model->city_id)
                        $selected = 'selected';
//                    ?>
                    <option value="<?= $val2->AMPHUR_ID ?>" <?= $selected ?>><?= $val2->AMPHUR_NAME ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-lg-3">
            <label for="">โซนพื้นที่</label>
            <select name="cityzone_id" class="form-control cityzone-id" id="cityzone-id">
                <option value="0">--เลือกโซนพื้นที่--</option>
                <?php foreach ($cityzone_data as $val3): ?>
                    <?php
                    $selected = '';
                    if ($val3->id == $model->cityzone_id)
                        $selected = 'selected';
//                    ?>
                    <option value="<?= $val3->id ?>" <?= $selected ?>><?= $val3->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'price_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('m/d/Y')
            ]) ?>
        </div>

    </div>

    <?php if($model->isNewRecord):?>

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-bordered" id="table-list">
                <thead>
                <tr>
                    <th>น้ำมัน</th>
                    <th style="text-align: right">ราคาวันนี้</th>
                    <th style="text-align: right">บวกเพิ่ม</th>
                    <th style="text-align: right">ราคาสุทธิ</th>
                    <th style="text-align: center"></th>
                </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>
    </div>
    <?php else:?>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-bordered" id="table-list">
                    <thead>
                    <tr>
                        <th>น้ำมัน</th>
                        <th style="text-align: right">ราคาวันนี้</th>
                        <th style="text-align: right">บวกเพิ่ม</th>
                        <th style="text-align: right">ราคาสุทธิ</th>
                        <th style="text-align: center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model_line as $value):?>
                    <tr>
                        <td>
                            <input type="hidden" name="line_fuel_id[]" class="form-control line-fuel-id" value="<?=$value->fuel_id?>'" />
                            <?=\backend\models\Fuel::findName($value->fuel_id)?>
                        </td>
                        <td>
                            <input style="text-align: right;" type="text" name="line_fuel_price[]" class="form-control line-fuel-price" readonly value="<?=$value->price_origin?>" />
                        </td>
                        <td>
                            <input style="text-align: right;" type="text" name="line_fuel_price_add[]" class="form-control line-fuel-price-add" value="<?=$value->price_add?>" onchange="getPrice($(this))" />
                        </td>
                        <td>
                            <input style="text-align: right;" type="text" name="line_fuel_price_total[]" class="form-control line-fuel-price-total" readonly value="<?=$value->price?>" />
                        </td>
                        <td></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif;?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$url_to_get_price = \yii\helpers\Url::to(['fueldailyprice/getapiprice'], true);
$url_to_getcity = \yii\helpers\Url::to(['customer/showcity'], true);
$js = <<<JS
$(function(){
   $(".btn-pull-price").on("click",function(){
       getapiprice();
   }) ;
});
function getapiprice(){
    $.ajax({
            'type': 'post',
            'dataType': 'html',
            'url': '$url_to_get_price',
            'data': {'date_price': ''},
            // alert(data)
            'success': function(data){
                if(data != ''){
                   $("#table-list tbody").html(data);
                }
            },
            'error': function(data){
                 alert(data);//return;
            }
        });
}
function getCity(e){
    $.post("$url_to_getcity"+"&id="+e.val(),function(data){
        $("select#city").html(data);
        $("select#city").prop("disabled","");
    });
}

function getPrice(e){
    var start_price = e.closest('tr').find('.line-fuel-price').val();
    var price_add = e.closest('tr').find('.line-fuel-price-add').val();
    // var new_price = 0;
    // alert(price_add);
    if(start_price != null && price_add != null){
          var new_price = parseFloat(start_price) + parseFloat(price_add);
          e.closest('tr').find('.line-fuel-price-total').val(addCommas(parseFloat(new_price).toFixed(2)));
          // e.closest('tr').find('.line-fuel-price-total').val(new_price);
      }
    
}
function addCommas(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
 }
JS;
$this->registerJs($js, static::POS_END);
?>
