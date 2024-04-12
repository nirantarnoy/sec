<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var backend\models\Car $model */
/** @var yii\widgets\ActiveForm $form */
$doc_type_data = \backend\helpers\CardocType::asArrayObject();
?>

    <div class="car-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'plate_no')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <!-- <?= $form->field($model, 'car_type_id')->textInput() ?> -->
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'brand_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\CarBrand::find()->all(), 'id', function ($data) {
                        return $data->name;
                    }),
                    'options' => [
                        'placeholder' => '--ยี่ห้อรถ--',
//                        'onchange' => 'showid($(this))',
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'car_type_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\CarType::find()->all(), 'id', function ($data) {
                        return $data->name;
                    }),
                    'options' => [
                        'placeholder' => '--ประเภทรถ--'
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'type_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\helpers\CarcatType::asArrayObject(), 'id', 'name'),
                    'options' => [
                        'placeholder' => '--ต่อพ่วง--',
                        'onchange' => 'showtail($(this))',
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'tail_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Car::find()->where(['type_id' => 2])->all(), 'id', 'name'),
                    'options' => [
                        'class' => 'tail-id',
                        'placeholder' => '--ต่อพ่วง--',
                        'disabled' => 'true',
                    ],

                ])->label('หาง') ?>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'horse_power')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'fuel_type')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\FuelType::find()->all(), 'id', function ($data) {
                        return $data->name;
                    }),
                    'options' => [
                        'placeholder' => '--ประเภทน้ำมัน--'
                    ]
                ]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'company_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Company::find()->all(), 'id', function ($data) {
                        return $data->name;
                    }),
                    'options' => [
                        'placeholder' => '--บริษัท--'
                    ]
                ]) ?>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'driver_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Employee::find()->all(), 'id', function ($data) {
                        return $data->fname . ' ' . $data->lname;
                    }),
                    'options' => [
                        'placeholder' => '--พนักงานขับรถ--',
//                        'onchange' => 'showid($(this))',
                    ]
                ]) ?>
            </div>
            <div class="col-lg-4">
                <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>

            </div>
        </div>
        <?php if ($model->doc == '' || $model->doc == null): ?>
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'doc')->fileInput(['maxlength' => true]) ?>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-12">
                    <label for="">เอกสารรถ</label>
                    <table class="table table-striped table-bordered">

                        <tbody>
                        <tr>
                            <td><?= $model->doc ?></td>
                            <td>
                                <a href="<?= \Yii::$app->getUrlManager()->getBaseUrl() . '/uploads/car_doc/' . $model->doc ?>"
                                   target="_blank">ดูเอกสาร</a></td>
                            <td>
                                <div data-var="<?= $model->doc ?>" class="btn btn-danger" onclick="removedoc($(this))">
                                    ลบ
                                </div>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>
            </div>

        <?php endif; ?>

        <div class="row">
            <div class="col-lg-12">
                <h5>เอกสารแนบ</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php if ($model_doc == null): ?>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 20%">ประเภท</th>
                            <th style="width: 55%">แนบเอกสาร</th>
                            <th>-</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for ($i = 0; $i <= count($doc_type_data) - 1; $i++): ?>
                            <tr>
                                <td><?= $doc_type_data[$i]['name'] ?></td>
                                <td>
                                    <input type="hidden" name="file_doc_type_id_<?= $i ?>"
                                           value="<?= $doc_type_data[$i]['id'] ?>">
                                    <input type="file" class="form-control" name="file_doc_<?= $i ?>">
                                </td>
                                <td></td>
                            </tr>
                        <?php endfor; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 20%">ประเภท</th>
                            <th style="width: 55%">แนบเอกสาร</th>
                            <th>-</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for ($i = 0; $i <= count($doc_type_data) - 1; $i++): ?>
                        <?php
                             $doc_link = '';
                             $doc_name = checkdocfile($model_doc, $doc_type_data[$i]['id']);
                            ?>

                            <tr>
                                <td><?= $doc_type_data[$i]['name'] ?></td>
                                <td>
                                    <input type="hidden" name="file_doc_type_id_<?= $i ?>"
                                           value="<?= $doc_type_data[$i]['id'] ?>">
                                    <input type="file" class="form-control" name="file_doc_<?= $i ?>">
                                </td>
                                <td>
                                    <a href="<?=\Yii::$app->getUrlManager()->baseUrl.'/uploads/car_doc/'.$doc_name?>" target="_blank"><?=$doc_name?></a>
                                </td>
                            </tr>
                        <?php endfor; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-lg-12">
                <h5>ข้อมูลผ่อนชำระ(ค่างวด)</h5>
            </div>
        </div>
        <?php
        $loan_all_amount = $model_car_loan!=null?$model_car_loan->loan_amount:0;
        $paymented_amount = checkpaymentamount($model->id);
        $paymented_period_cnt = checkpaymentcnt($model->id);
        $paymented_lasted = getpaymentlasted($model->id);
        $period_payment_count = checkpaymentcnt($model->id);
        $period_all_count = checkperiodcnt($model->id);
        ?>
        <div class="row">
            <div class="col-lg-3">
                <label for="">เลขที่สัญญา</label>
                <input type="text" name="car_loan_doc_no" class="form-control car-loan-doc-no" value="<?=$model_car_loan!=null?$model_car_loan->doc_no:''?>">
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-lg-3">
                <label for="">ยอดเงินทั้งหมด</label>
                <input type="text" name="car_loan_all_amount" class="form-control car-loan-all-amount" value="<?=number_format($loan_all_amount,0)?>">
            </div>
            <div class="col-lg-3">
                <label for="">ยอดเงินชำระแล้ว</label>
                <input type="text" name="car_loan_payment_amount" class="form-control car-loan-payment-amount" readonly value="<?=number_format($paymented_amount,0)?>">
            </div>
            <div class="col-lg-3">
                <label for="">ยอดคงค้าง</label>
                <input type="text" name="car_loan_remain_amount" class="form-control car-loan-remain-amount" readonly value="<?=number_format(($loan_all_amount - $paymented_amount),0)?>">
            </div>
            <div class="col-lg-3">
                <label for="">วันที่ชำระล่าสุด</label>
                <input type="text" name="car_loan_last_payment" class="form-control car-loan-last-payment" readonly value="<?=$paymented_lasted?>">
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-lg-3">
                <label for="">จำนวนงวดทั้งหมด</label>
                <input type="text" name="car_loan_period_total" class="form-control car-loan-period-total" value="<?=$model_car_loan!=null?$model_car_loan->total_period:0?>">
            </div>
            <div class="col-lg-3">
                <label for="">จำนวนเงินต่องวด</label>
                <input type="text" name="car_loan_period_amount" class="form-control car-loan-period-amount" value="<?=$model_car_loan!=null?$model_car_loan->period_amount:0?>">
            </div>
            <div class="col-lg-3">
                <label for="">ชำระแล้ว(งวด)</label>
                <input type="text" name="car_loan_period_payment_count" class="form-control car-loan-period-payment-count" readonly value="<?=$period_payment_count?>">

            </div>
            <div class="col-lg-3">
                <label for="">คงเหลือ(งวด)</label>
                <input type="text" name="car_loan_period_remain" class="form-control car-loan-period-remain" readonly value="<?=($period_all_count - $period_payment_count)?>">

            </div>
        </div>
        <br />

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <form id="form-delete-doc" action="<?= \yii\helpers\Url::to(['car/removedoc'], true) ?>" method="post">
        <input type="hidden" name="car_id" value="<?= $model->id ?>">
        <input type="hidden" class="car-doc-delete" name="doc_name" value="">
    </form>

<?php
 function checkdocfile($model_doc ,$line_id){
     $name = '';
     if($model_doc != null){
         foreach($model_doc as $value){
             if($value->doc_type_id == $line_id){
                 $name = $value->docname;
             }
         }
     }
     return $name;
 }

function checkpaymentamount($car_id){
    $amount = 0;
    if($car_id){
        $model = \common\models\CarLoanTrans::find()->where(['car_loan_id'=>$car_id])->sum('loan_pay_amt');
        if($model){
            $amount = $model;
        }
    }
    return $amount;
}
function checkpaymentcnt($car_id){
    $amount = 0;
    if($car_id){
        $model = \common\models\CarLoanTrans::find()->where(['car_loan_id'=>$car_id])->count();
        if($model){
            $amount = $model;
        }
    }
    return $amount;
}
function checkperiodcnt($car_id){
    $amount = 0;
    if($car_id){
        $model = \common\models\CarLoan::find()->where(['car_id'=>$car_id])->one();
        if($model){
            $amount = $model->total_period;
        }
    }
    return $amount;
}

function getpaymentlasted($car_id){
     $date_data = null;
     if($car_id){
         $model = \common\models\CarLoanTrans::find()->where(['car_loan_id'=>$car_id])->max('trans_date');
         if($model != null){
             $date_data = $model;
         }
     }
     return $date_data;
 }
?>

<?php
$js = <<<JS
$(function (){
    
});
function showtail(e){
    var id = e.val();
    if(id == 1){
        $(".tail-id").prop("disabled","");
    }else{
        $(".tail-id").prop("disabled","disabled");
    }
}
function removedoc(e){
    var doc_name = e.attr("data-var");
    $(".car-doc-delete").val(doc_name);
    if(doc_name != ''){
        $("form#form-delete-doc").submit();
    }
}

function showid(e){
    var id = e.val();
    alert(e.val());
}

JS;
$this->registerJs($js, static::POS_END);

?>