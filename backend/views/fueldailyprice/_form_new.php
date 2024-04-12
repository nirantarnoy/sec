<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Fueldailyprice $model */
/** @var yii\widgets\ActiveForm $form */
$car_typ_data = \backend\models\CarType::find()->all();
$province_data = \backend\models\Province::find()->all();
//$province_chk = \backend\models\AddressInfo::findProvinceShowname($model->province_id);
$city_data = \backend\models\Amphur::find()->all();
//$city_chk = \backend\models\AddressInfo::findAmphurShowname($model->city_id);
?>

<div class="fueldailyprice-form">
    <?php if ($model->isNewRecord): ?>
        <div class="row">
            <div class="col-lg-3">
                <div class="btn btn-info btn-pull-price">ดึงราคาน้ำมัน (วันนี้)</div>
            </div>
        </div>
    <?php endif; ?>
    <br/>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-3">
            <label for="">ประเภทรถ</label>
            <?php
            echo \kartik\select2\Select2::widget([
                'name' => 'car_type_id',
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\CarType::find()->all(), 'id', 'name'),
                'value' => $model->car_type_id,
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ])
            ?>
        </div>
        <div class="col-lg-3">
            <label for="">จังหวัด</label>
            <?php
            echo \kartik\select2\Select2::widget([
                'name' => 'province_id',
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Province::find()->all(), 'PROVINCE_ID', 'PROVINCE_NAME'),
                'value' => $model->province_id,
                'options' => [
                    'id' => 'province-id',
                    'onchange' => 'getCity($(this))',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ])
            ?>
        </div>
<!--        <div class="col-lg-3">-->
<!--            <label for="">อำเภอ/เขต</label>-->
<!---->
<!--            --><?php
//            echo \kartik\select2\Select2::widget([
//                'name' => 'city_id',
//                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Amphur::find()->all(), 'AMPHUR_ID', 'AMPHUR_NAME'),
//                'value' => $model->province_id,
//                'options' => [
//                    'id' => 'city',
//                    'onchange' => '',
//                ],
//                'pluginOptions' => [
//                    'allowClear' => true,
//                ]
//            ])
//            ?>
<!--        </div>-->
        <div class="col-lg-3">
            <label for="">โซนพื้นที่</label>

            <?php
            echo \kartik\select2\Select2::widget([
                'name' => 'cityzone_id',
                'data' => \yii\helpers\ArrayHelper::map(\common\models\Cityzone::find()->all(), 'id', 'name'),
                'value' => $model->province_id,
                'options' => [
                    'id' => 'cityzone-id',
                    'placeholder' => '--เลือกโซนพื้นที่--',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ])
            ?>
        </div>



    </div>
    <br/>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'price_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('m/d/Y')
            ]) ?>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-lg-2">
            <label for="">บวกเพิ่ม(บาท)</label>
            <input type="text" class="form-control add-all-price" value="0">
        </div>
        <div class="col-lg-3">
            <div style="height: 31px;"></div>
            <div class="btn btn-primary" onclick="updatelineall()">อัพเดททั้งหมดเป็นจำนวนนี้</div>
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3"></div>
    </div>
    <br/>
    <?php if ($model->isNewRecord): ?>

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
    <?php else: ?>
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
                    <?php foreach ($model_line as $value): ?>
                        <tr>
                            <td>
                                <input type="hidden" name="line_fuel_id[]" class="form-control line-fuel-id"
                                       value="<?= $value->fuel_id ?>'"/>
                                <?= \backend\models\Fuel::findName($value->fuel_id) ?>
                            </td>
                            <td>
                                <input style="text-align: right;" type="text" name="line_fuel_price[]"
                                       class="form-control line-fuel-price" readonly
                                       value="<?= $value->price_origin ?>"/>
                            </td>
                            <td>
                                <input style="text-align: right;" type="text" name="line_fuel_price_add[]"
                                       class="form-control line-fuel-price-add" value="<?= $value->price_add ?>"
                                       onchange="getPrice($(this))"/>
                            </td>
                            <td>
                                <input style="text-align: right;" type="text" name="line_fuel_price_total[]"
                                       class="form-control line-fuel-price-total" readonly
                                       value="<?= $value->price ?>"/>
                            </td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>


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
     //alert(price_add);
    if(start_price != null && price_add != null){
          var new_price = parseFloat(start_price)+ parseFloat(price_add);
          e.closest('tr').find('.line-fuel-price-total').val(addCommas(parseFloat(new_price).toFixed(2)));
          // e.closest('tr').find('.line-fuel-price-total').val(new_price);
      }
    
}

function updatelineall(){
    var price_for_udpate = $(".add-all-price").val();
    if(price_for_udpate >0){
        $("#table-list tbody tr").each(function(){
           // var line_price_add = $(this).find(".line-fuel-price-add").val();
            $(this).find(".line-fuel-price-add").val(price_for_udpate);
             var start_price = $(this).find('.line-fuel-price').val();
            var price_add = $(this).find('.line-fuel-price-add').val();
            // var new_price = 0;
              1.02
            if(start_price != null && price_add != null){
                  var new_price = parseFloat(start_price) + parseFloat(price_add);
                  // alert(new_price);
                  $(this).find('.line-fuel-price-total').val(addCommas(parseFloat(new_price).toFixed(2)));
                  // e.closest('tr').find('.line-fuel-price-total').val(new_price);
              } 
        });
        
       
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
