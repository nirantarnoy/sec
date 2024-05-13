<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
$data_warehouse = \backend\models\Warehouse::find()->all();
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'barcode')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'product_group_id')->widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Productgroup::find()->all(), 'id', 'name'),
                'options' => [

                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'cost_price')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'sale_price')->textInput() ?>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-3">
            <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>
        </div>
        <div class="col-lg-3"></div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-6">
            <label for="">รูปภาพ</label>
            <?php if ($model->isNewRecord): ?>
                <table style="width: 100%">
                    <tr>
                        <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                            <i class="fa fa-ban fa-lg" style="color: grey"></i>
                            <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                        </td>
                    </tr>
                </table>
            <?php else: ?>
                <table style="width: 100%">
                    <tr>
                        <?php if ($model->photo != ''): ?>
                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                <a href="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo ?>"
                                   target="_blank"><img
                                            src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo ?>"
                                            style="max-width: 130px;margin-top: 5px;" alt=""></a>
                            </td>
                        <?php else: ?>
                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                            </td>
                        <?php endif; ?>
                    </tr>
                </table>
            <?php endif; ?>
            <input type="file" name="product_photo" class="form-control">
        </div>
        <div class="col-lg-6">
            <label for="">รูปภาพ</label>
            <?php if ($model->isNewRecord): ?>
                <table style="width: 100%">
                    <tr>
                        <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                            <i class="fa fa-ban fa-lg" style="color: grey"></i>
                            <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                        </td>
                    </tr>
                </table>
            <?php else: ?>
                <table style="width: 100%">
                    <tr>
                        <?php if ($model->photo_2 != ''): ?>
                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                <a href="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo_2 ?>"
                                   target="_blank"><img
                                            src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo_2 ?>"
                                            style="max-width: 130px;margin-top: 5px;" alt=""></a>
                            </td>
                        <?php else: ?>
                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                            </td>
                        <?php endif; ?>
                    </tr>
                </table>
            <?php endif; ?>
            <input type="file" name="product_photo_2" class="form-control">
        </div>

    </div>
    <br />
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
                    <th style="text-align: center;">วันหมดอายุ</th>
                </tr>
                </thead>
                <tbody>
                <?php if($model_line != null):?>
                <?php foreach($model_line as $value):?>
                    <tr>
                        <td>
                            <input type="hidden" class="form-control line-rec-id" name="line_rec_id[]" value="<?=$value->id?>">
                            <select name="warehouse_id[]" id="" class="form-control line-warehouse-id">
                                <option value="-1">--เลือก-</option>
                                <?php foreach($data_warehouse as $xvalue):?>
                                <?php
                                    $selected = '';
                                    if($value->warehouse_id == $xvalue->id){
                                        $selected = 'selected';
                                    }
                                    ?>
                                    <option value="<?=$xvalue->id?>" <?=$selected?>><?=$xvalue->name?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control line-qty" name="line_qty[]" value="<?=$value->qty?>">
                        </td>
                        <td>
                            <input type="text" class="form-control line-exp-date" name="line_exp_date[]" value="<?=date('d/m/Y',strtotime($value->expired_date))?>">
                        </td>

                    </tr>
                <?php endforeach;?>
                <?php else:?>
                    <tr>
                        <td>
<!--                            <input type="text" class="form-control line-warehouse-id" name="warehouse_id[]" value="">-->
                            <input type="hidden" class="form-control line-rec-id" name="line_rec_id[]" value="0">
                            <select name="warehouse_id[]" id="" class="form-control line-warehouse-id">
                                <option value="-1">--เลือก-</option>
                                <?php foreach($data_warehouse as $xvalue):?>
                                    <option value="<?=$xvalue->id?>"><?=$xvalue->name?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control line-qty" name="line_qty[]" value="">
                        </td>
                        <td>
                            <input type="text" class="form-control line-exp-date" name="line_exp_date[]" value="">
                        </td>

                    </tr>
                <?php endif;?>

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
    <br />

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js=<<<JS
$(function(){
  // $(".line-exp-date").datepicker(); 
});
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
                removelist2.push(e.parent().parent().attr("data-var"));
                $(".remove-list2").val(removelist2);
            }
            // alert(removelist);
            // alert(e.parent().parent().attr("data-var"));

            if ($("#table-list2 tbody tr").length == 1) {
                $("#table-list2 tbody tr").each(function () {
                    $(this).find(":text").val("");
                   // $(this).find(".line-prod-photo").attr('src', '');
                   
                     $(this).find(".price-line").val(0);
                    $(this).find(".remark-line").val('');
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
$this->registerJs($js,static::POS_END);
?>