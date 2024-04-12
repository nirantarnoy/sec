<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Carloantrans $model */
/** @var yii\widgets\ActiveForm $form */


$loan_data = null;
if(!$model->isNewRecord){
    $loan_data = getLoandata($model->car_loan_id);
}

?>

    <div class="carloantrans-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'car_loan_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Car::find()->all(), 'id', function ($data) {
                        return $data->name;
                    }),
                    'options' => [
                        'id' => 'car-selected-id',
                        'placeholder' => '--เลือกรถหรือพ่วง--',
                        'onchange' => 'pullcarloandata($(this))',
                    ],
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?php $model->trans_date = !$model->isNewRecord?date('d/m/Y',strtotime($model->trans_date)):date('d/m/Y');?>
                <?= $form->field($model, 'trans_date')->widget(\kartik\date\DatePicker::className(), [
                    'value' => date('d/m/Y'),
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'format'=>'dd/mm/yyyy'
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'period_no')->textInput(['readonly' => 'readonly', 'id' => 'period-no']) ?>
            </div>
            <div class="col-lg-3">
                <label for="">เลขที่สัญญา</label>
                <input type="text" class="form-control loan-doc-no" value="<?=$loan_data!=null?$loan_data[0]['loan_doc_no']:''?>" name="" readonly>
            </div>

        </div>
        <br/>
        <div class="row">
            <div class="col-lg-3">
                <label for="">ยอดชำระรายเดือน</label>
                <input type="text" class="form-control payment-standard-amt" value="<?=$loan_data!=null?$loan_data[0]['payment_std_amt']:''?>" name="" readonly>
            </div>
            <div class="col-lg-3">
                <label for="">จำนวนงวดที่ต้องชำระ</label>
                <input type="text" class="form-control period-count" value="<?=$loan_data!=null?$loan_data[0]['period_count']:''?>" name="" readonly>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'loan_pay_amt')->textInput() ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'doc')->fileInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-submit-click']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php

function getLoandata($id){
    $data = [];
    if($id){
        $model = \common\models\CarLoan::find()->where(['car_id'=>$id])->one();
        if($model){
            $period_no = 1;
            $model_trans = \common\models\CarLoanTrans::find()->where(['car_loan_id'=>$id])->count();
            if($model_trans){
                $period_no = ($model_trans + 1);
            }
            array_push($data,[
                    'payment_std_amt'=>$model->period_amount,
                    'period_count'=>$model->total_period,
                    'loan_doc_no'=>$model->doc_no
            ]);
        }
    }
    return $data;
}



$url_to_find_customer_data = \yii\helpers\Url::to(['carloantrans/findcustomerdata'], true);
$js = <<<JS
$(function(){
    
});
function pullcarloandata(e){
    var car_id = e.val();
     if(car_id != ''){
          $.ajax({
                 type: "post",
                 dataType: "json",
                 url: "$url_to_find_customer_data",
                 async: false,
                 data: {'car_id': car_id},
                 success: function(data){
                     if(data.length > 0){
                        // alert();
                        // alert(data[0]['payment_std_amt']);
                         $(".payment-standard-amt").val(data[0]['payment_std_amt']);
                         $(".period-count").val(data[0]['period_count']);
                         $("#period-no").val(data[0]['period_no']);
                         $(".loan-doc-no").val(data[0]['loan_doc_no']);
                         
                         if(parseInt(data[0]['period_no']) > parseInt(data[0]['period_count'])){
                             $(".btn-submit-click").hide();
                         }
                     }else{
                         $(".payment-standard-amt").val(0);
                         $(".loan-doc-no").val('');
                         $(".period-count").val(0);
                         $("#period-no").val(0);
                     }
                 }
          }); 
     }
}
JS;
$this->registerJs($js, static::POS_END);
?>