<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\grid\GridView;
/** @var yii\web\View $this */
/** @var backend\models\Jobmain $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="jobmain-form">
<!--    <div id="tagsContainer" style="margin-top: 10px; border: 1px solid #ccc; padding: 5px; min-height: 30px;"></div>-->
    <?php $form = ActiveForm::begin(); ?>
    <input type="hidden" id="jobmain-id" value="<?=$model->id?>">
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'team_id')->widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\Team::find()->where(['status'=>1])->all(), 'id', 'name'),
                'options' => ['id'=>'team-id','placeholder' => 'Select a team ...','onchange'=>'getemployee($(this));'],
                'pluginOptions' => ['allowClear' => true],
            ]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'emp_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>\yii\helpers\ArrayHelper::map(\backend\models\Employee::find()->where(['status'=>1])->all(),'id',function($data){
                    return $data->f_name.' '.$data->l_name;
                }),
                'options' => ['id'=>'head-id','placeholder' => 'Select a head ...','class'=>'selected-head-id'],
                'pluginOptions' => ['allowClear' => true],
            ]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'job_month')->widget(\kartik\date\DatePicker::className(),[
                'pluginOptions'=>[
                    'format'=>'dd-mm-yyyy',
                ]
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <b>ข้อมูลลูกค้า / Customer information</b>
                </div>
            </div>
            <form action="">
            <div class="row">
                <div class="col-lg-3">
                    <label for="">เลขที่งาน / Job No</label>
                    <input type="text" class="form-control" value="" readonly="readonly">
                </div>
                <div class="col-lg-3">
                    <label for="">ชื่อลูกค้า / Customer Name</label>
                    <?php
                       echo \kartik\select2\Select2::widget([
                               'name'=>'customer_id',
                               'data' => \yii\helpers\ArrayHelper::map(\common\models\Customer::find()->where(['status'=>1])->all(), 'id', function($data){
                                   return $data->first_name.' '.$data->last_name;
                               }),
                           'options' => ['id'=>'customer-id','placeholder' => 'Select a customer ...'],
                           'pluginOptions' => ['allowClear' => true],
                       ])
                    ?>
                </div>
                <div class="col-lg-3">
                    <label for="">ใบเสนอราคาเลขที่ / Quotation No.</label>
                    <br />
                    <!-- Input Field -->
                    <?= Html::textInput('tagInput', '', [
                        'class' => 'tag-input',
                        'id' => 'tagInput',
                        'placeholder' => 'Type and press space...',
                        'style' => 'width: 100%; padding: 5px;'
                    ]) ?>

                    <!-- Hidden Field to Store Tags (For Form Submission) -->
                    <?= Html::hiddenInput('quotation_tags', '', ['id' => 'hiddenTags']) ?>
                </div>
                <div class="col-lg-3">
                    <label for="">ใบกำกับภาษีเลขที่ / Invoice No.</label>
                    <br />
                    <!-- Input Field -->
                    <?= Html::textInput('tagInput2', '', [
                        'class' => 'tag-input-2',
                        'id' => 'tagInput2',
                        'placeholder' => 'Type and press space...',
                        'style' => 'width: 100%; padding: 5px;'
                    ]) ?>

                    <!-- Hidden Field to Store Tags (For Form Submission) -->
                    <?= Html::hiddenInput('invoice_tags', '', ['id' => 'hiddenInvoiceTags']) ?>
                </div>
            </div>
            </form>
            <br />
            <div class="row">
                <div class="col-lg-3">
                    <button class="btn btn-primary btn-save" onclick="addJob();">เพิ่มข้อมูลใบงาน</button>
                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-6"><b>รายการใบงาน</b></div>
    </div>
    <div class="job-index">
        <?php if (\Yii::$app->session->getFlash('success') !== null): ?>
            <div class="alert alert-success">
                <?= \Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'emptyCell' => '-',
            'layout' => "{items}\n{summary}\n<div class='text-center'>{pager}</div>",
            'summary' => "แสดง {begin} - {end} ของทั้งหมด {totalCount} รายการ",
            'showOnEmpty' => false,
            //    'bordered' => true,
            //     'striped' => false,
            //    'hover' => true,
            'id' => 'product-grid',
            //'tableOptions' => ['class' => 'table table-hover'],
            'emptyText' => '<div style="color: red;text-align: center;"> <b>ไม่พบรายการไดๆ</b> <span> เพิ่มรายการโดยการคลิกที่ปุ่ม </span><span class="text-success">"สร้างใหม่"</span></div>',
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'headerOptions' => ['style' => 'text-align: center'],
                    'contentOptions' => ['style' => 'text-align: center']],
               // 'job_no',
                [
                    'attribute' => 'customer_id',
                    'value' => function ($data) {
                        return \backend\models\Customer::findCusFullName($data->customer_id);
                    }
                ],
                'quotation_ref_no',
                'invoice_ref_no',
//                [
//                    'attribute' => 'team_id',
//                    'value' => function ($data) {
//                        return \backend\models\Team::findName($data->team_id);
//                    }
//                ],
//                [
//                    'attribute' => 'trans_date',
//                    'value' => function ($data) {
//                        return $data->trans_date != null ? date('d-m-Y', strtotime($data->trans_date)) : '';
//                    }
//                ],


                [
                    'attribute' => 'head_id',
                    'value' => function ($data) {
                        return \backend\models\Employee::findFullName($data->head_id);
                    }
                ],
                [
                    'attribute' => 'status',
                    'value' => function ($data) {
                        return \backend\helpers\JobStatus::getTypeById($data->status);
                    }
                ],
                [
                    'attribute' => 'payment_status',
                    'value' => function ($data) {
                        return \backend\models\Paymentstatus::findName($data->payment_status);
                    }
                ],
                //'status',
                //'created_at',
                //'created_by',
                //'updated_at',
                //'updated_by',
                [

                    'header' => 'ตัวเลือก',
                    'headerOptions' => ['style' => 'text-align:center;', 'class' => 'activity-view-link',],
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => 'text-align: center'],
                    'template' => '{view} {update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $data, $index) {
                            $options = [
                                'title' => Yii::t('yii', 'View'),
                                'aria-label' => Yii::t('yii', 'View'),
                                'data-pjax' => '0',
                            ];
                            return Html::a(
                                '<span class="fas fa-eye btn btn-xs btn-default"></span>', $url, $options);
                        },
                        'update' => function ($url, $data, $index) {
                            $options = array_merge([
                                'title' => Yii::t('yii', 'Update'),
                                'aria-label' => Yii::t('yii', 'Update'),
                                'data-pjax' => '0',
                                'id' => 'modaledit',
                            ]);
//                            return Html::a(
//                                '<span class="fas fa-edit btn btn-xs btn-default"></span>', $url, [
//                                'id' => 'activity-view-link',
//                                //'data-toggle' => 'modal',
//                                // 'data-target' => '#modal',
//                                'data-id' => $index,
//                                'data-pjax' => '0',
//                                // 'style'=>['float'=>'rigth'],
//                            ]);
                            return Html::a('<span class="fas fa-edit btn btn-xs btn-default"></span>', 'index.php?r=job/update&id=' . $data->id , $options);
                        },
                        'delete' => function ($url, $data, $index) {
                            $options = array_merge([
                                'title' => Yii::t('yii', 'Delete'),
                                'aria-label' => Yii::t('yii', 'Delete'),
                                //'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                //'data-method' => 'post',
                                //'data-pjax' => '0',
                                'data-url' => $url,
                                'data-var' => $data->id,
                                'onclick' => 'recDelete($(this));'
                            ]);
                            return Html::a('<span class="fas fa-trash-alt btn btn-xs btn-default"></span>', 'javascript:void(0)', $options);
                        }
                    ]
                ],
            ],
            'pager' => ['class' => LinkPager::className()],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>

</div>


<?php
$url_to_find_employee =\yii\helpers\Url::to(['job/getemployee'], true);
$url_to_add_job =\yii\helpers\Url::to(['jobmain/createjob'], true);
$js = <<<JS
var selecteditem = [];
var removelist = [];
$(function(){
   let tags = []; // Array to store tags
   let tags2 = []; // Array to store tags

    $('#tagInput').on('keyup', function(event) {
        let input = $(this);
        let value = input.val().trim();

        // If space or enter is pressed
        if ((event.which === 32 || event.which === 13) && value !== '') {
            // Prevent form submission on Enter
            event.preventDefault();

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
        }
    });
    
    $('#tagInput2').on('keyup', function(event) {
        let input = $(this);
        let value = input.val().trim();

        // If space or enter is pressed
        if ((event.which === 32 || event.which === 13) && value !== '') {
            // Prevent form submission on Enter
            event.preventDefault();

            // Check if tag already exists
            if (!tags2.includes(value)) {
                tags2.push(value); // Add to tag list

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
                $('#hiddenInvoiceTags').val(tags2.join(','));

                // Clear input for next tag
                input.val('');

                // Remove tag when clicking "✖"
                tag.find('.remove-tag').click(function() {
                    let text = $(this).parent().text().trim().slice(0, -1); // Remove '✖' character
                    tags2 = tags2.filter(t => t !== text); // Remove from array
                    $('#hiddenInvoiceTags').val(tags2.join(',')); // Update hidden field
                    $(this).parent().remove(); // Remove tag element
                });
            } else {
                input.val(''); // Clear duplicate entry
            }
        }
    });
});
function getemployee(e){
    var id = $(e).val();
    var url = "$url_to_find_employee";
    $.ajax({
        url: url,
        type: 'html',
        data: {id: id},
        success: function (data) {
           if(data != null || data != ""){
               $(".selected-head-id").html(data);
           }
        }
    });
}

function addJob(){
    var url = "$url_to_add_job";
    var jobmain_id = $("#jobmain-id").val();
    var customer_id = $("#customer-id").val();
    var tags = $("#hiddenTags").val();
    var tags2 = $("#hiddenInvoiceTags").val();
    var team_id = $("#team-id").val();
    var head_id = $("#head-id").val();
    
   
    if(jobmain_id && customer_id){
         alert(team_id);
        $.ajax({
        url: url,
        type: 'post',
        dataType: 'html',
        data: {id: jobmain_id,customer_id:customer_id,tags:tags,tags2:tags2,team_id:team_id,head_id:head_id},
        success: function (data) {
           alert('ok');
        },
        error: function (err) {
            alert('error');
        }
    });
    }
    
}   

JS;

$this->registerJs($js,static::POS_END);

?>