<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\Jobmain $model */
/** @var yii\widgets\ActiveForm $form */

$model_job_main_com_std = \common\models\JobProfitComStd::find()->where(['job_id' => $model->id, 'type_id' => 0])->all();
$model_job_main_com_std_sum = \common\models\JobProfitComStd::find()->where(['job_id' => $model->id, 'type_id' => 1])->one();
$model_job_main_com_std_sum_level_2 = \common\models\JobProfitComStd::find()->where(['job_id' => $model->id, 'type_id' => 2])->one();
//$model_job_main_com_share_sum = \common\models\JobComShare::find()->where(['job_id' => $model->id])->all();
?>

    <div class="jobmain-form">
        <!--    <div id="tagsContainer" style="margin-top: 10px; border: 1px solid #ccc; padding: 5px; min-height: 30px;"></div>-->
        <?php $form = ActiveForm::begin(); ?>
        <input type="hidden" id="jobmain-id" value="<?= $model->id ?>">
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'team_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Team::find()->where(['status' => 1, 'team_type_id' => 1])->all(), 'id', 'name'),
                    'options' => ['id' => 'team-id', 'placeholder' => 'Select a team ...', 'onchange' => 'getemployee($(this));'],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'emp_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Employee::find()->where(['status' => 1])->all(), 'id', function ($data) {
                        return $data->f_name . ' ' . $data->l_name;
                    }),
                    'options' => ['id' => 'head-id', 'placeholder' => 'Select a head ...', 'class' => 'selected-head-id'],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'job_month')->widget(\kartik\date\DatePicker::className(), [
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                    ]
                ]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('เพิ่มรายงาน / Add Report', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <?php if (!$model->isNewRecord): ?>
            <br/>
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
                                    'name' => 'customer_id',
                                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Customer::find()->where(['status' => 1])->orderBy(['can_new' => SORT_ASC])->all(), 'id', function ($data) {
                                        return $data->name;
                                    }),
                                    'options' => ['id' => 'selected-customer-id', 'placeholder' => 'Select a customer ...',
                                        'onchange' => 'checkcreateNew($(this));',],
                                    'pluginOptions' => ['allowClear' => true],
                                ])
                                ?>
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
                                <?= Html::hiddenInput('quotation_tags', '', ['id' => 'hiddenTags']) ?>
                            </div>
                            <div class="col-lg-3">
                                <label for="">ใบกำกับภาษีเลขที่ / Invoice No.</label>
                                <br/>
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
                            <div class="col-lg-3">
                                <label for="">พนักงานขาย</label>
                                <?php
                                echo \kartik\select2\Select2::widget([
                                    'name' => 'emp_slae_id',
                                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Employee::find()->where(['status' => 1])->orderBy(['id' => SORT_ASC])->all(), 'id', function ($data) {
                                        return $data->f_name.' '.$data->l_name;
                                    }),
                                    'options' => ['id' => 'selected-employee-id', 'placeholder' => 'Select a employee ...',],
                                    'pluginOptions' => ['allowClear' => true],
                                ])
                                ?>
                            </div>
                        </div>
                    </form>
                    <br/>
                    <div class="row">
                        <div class="col-lg-3">
                            <button class="btn btn-primary btn-save" onclick="addJob();">เพิ่มข้อมูลใบงาน</button>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-6"><b>รายการใบงาน</b></div>
            </div>
            <div class="job-index" style="overflow: hidden">
                <?php if (\Yii::$app->session->getFlash('success') !== null): ?>
                    <div class="alert alert-success">
                        <?= \Yii::$app->session->getFlash('success') ?>
                    </div>
                <?php endif; ?>
                <?php if ($dataProvider != null): ?>
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
                        'responsive' => true,
                        'showPageSummary' => true,
                        'id' => 'job-grid',

                        //   'tableOptions' => ['class' => 'table table-responsive table-hover'],
                        'tableOptions' => ['style' => 'table-layout: auto;width: 150%;'],
                        'emptyText' => '<div style="color: red;text-align: center;"> <b>ไม่พบรายการไดๆ</b> <span> เพิ่มรายการโดยการคลิกที่ปุ่ม </span><span class="text-success">"สร้างใหม่"</span></div>',
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'headerOptions' => ['style' => 'text-align: center;width: 3% !important;'],
                                'contentOptions' => ['style' => 'text-align: center;width: 3% !important;'],],
                            // 'job_no',
                            [
                                'attribute' => 'customer_id',
                                'headerOptions' => ['style' => 'width: 5% !important;'],
                                'contentOptions' => ['style' => 'width: 5% !important;'],
                                'value' => function ($data) {
                                    return \backend\models\Customer::findCusFullName($data->customer_id);
                                }
                            ],
                            [
                                'attribute' => 'quotation_ref_no',
                                'headerOptions' => ['style' => 'width: 5% !important;'],
                                'contentOptions' => ['style' => 'width: 5% !important;'],
                                'value' => function ($data) {
                                    return $data->quotation_ref_no;
                                }
                            ],
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
                                'attribute' => 'job_type_id',
                                'value' => function ($data) {
                                    return \backend\models\Worktype::findName($data->job_type_id);
                                }
                            ],
                            [
                                'attribute' => 'install_team_id',
                                'value' => function ($data) {
                                    return \backend\models\Team::findName($data->install_team_id);
                                }
                            ],
                            [
                                'attribute' => 'main_distributor_id',
                                'value' => function ($data) {
                                    return \backend\models\Distributor::findName($data->main_distributor_id);
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function ($data) {
                                    return \backend\helpers\JobStatus::getTypeById($data->status);
                                }
                            ],
                            [
                                'attribute' => 'paid_amount',
                                'contentOptions' => ['style' => 'text-align: right'],
                                'value' => function ($data) {
                                    //  return number_format($data->paid_amount != null ? $data->paid_amount : 0, 2);
                                    return $data->paid_amount != null ? $data->paid_amount : 0;
                                },
                                'format' => ['decimal', 2],
                                'hAlign' => 'right',
                                'pageSummary' => true,
                                'pageSummaryFunc' => GridView::F_SUM
                            ],
                            [
                                'attribute' => 'withholding_amount',
                                'contentOptions' => ['style' => 'text-align: right'],
                                'value' => function ($data) {
                                    //   return number_format($data->withholding_amount != null ? $data->withholding_amount : 0, 2);
                                    return $data->withholding_amount != null ? $data->withholding_amount : 0;
                                },
                                'format' => ['decimal', 2],
                                'hAlign' => 'right',
                                'pageSummary' => true,
                                'pageSummaryFunc' => GridView::F_SUM
                            ],
                            [
                                'attribute' => 'pending_amount',
                                'contentOptions' => ['style' => 'text-align: right'],
                                'value' => function ($data) {
                                    // return number_format($data->pending_amount != null ? $data->pending_amount : 0, 2);
                                    return $data->pending_amount != null ? $data->pending_amount : 0;
                                },
                                'format' => ['decimal', 2],
                                'hAlign' => 'right',
                                'pageSummary' => true,
                                'pageSummaryFunc' => GridView::F_SUM
                            ],
                            [
                                'attribute' => 'payment_status',
                                'contentOptions' => ['style' => 'text-align: center'],
                                'format' => 'raw',
                                'value' => function ($data) {
                                    $status = \backend\models\Paymentstatus::findName($data->payment_status);
                                    if ($data->payment_status == 1) {
                                        return '<div class="badge badge-danger">' . $status . '</div>';
                                    } else if ($data->payment_status == 2) {
                                        return '<div class="badge badge-warning">' . $status . '</div>';
                                    } else if ($data->payment_status == 3) {
                                        return '<div class="badge badge-success">' . $status . '</div>';
                                    }
                                }
                            ],
                            [
                                'attribute' => 'job_value_amount',
                                'contentOptions' => ['style' => 'text-align: right'],
                                'label' => 'มูลค่างาน',
                                'value' => function ($data) {
                                    // return number_format($data->job_value_amount != null ? $data->job_value_amount : 0, 2);
                                    return $data->job_value_amount != null ? $data->job_value_amount : 0;
                                },
                                'format' => ['decimal', 2],
                                'hAlign' => 'right',
                                'pageSummary' => true,
                                'pageSummaryFunc' => GridView::F_SUM
                            ],
                            [
                                'attribute' => 'job_cost_amount',
                                'contentOptions' => ['style' => 'text-align: right'],
                                'value' => function ($data) {
                                    // return number_format($data->job_cost_amount != null ? $data->job_cost_amount : 0, 2);
                                    return $data->job_cost_amount != null ? $data->job_cost_amount : 0;
                                },
                                'format' => ['decimal', 2],
                                'hAlign' => 'right',
                                'pageSummary' => true,
                                'pageSummaryFunc' => GridView::F_SUM
                            ],
                            [
                                'attribute' => 'job_benefit_amount',
                                'contentOptions' => ['style' => 'text-align: right'],
                                'value' => function ($data) {
                                    // return number_format($data->job_benefit_amount != null ? $data->job_benefit_amount : 0, 2);
                                    return $data->job_benefit_amount != null ? $data->job_benefit_amount : 0;
                                },
                                'format' => ['decimal', 2],
                                'hAlign' => 'right',
                                'pageSummary' => true,
                                'pageSummaryFunc' => GridView::F_SUM
                            ],
                            [
                                'attribute' => 'job_benefit_per',
                                'contentOptions' => ['style' => 'text-align: right'],
                                'value' => function ($data) {
                                    // return number_format($data->job_benefit_per != null ? $data->job_benefit_per : 0, 2);
                                    return $data->job_benefit_per != null ? $data->job_benefit_per : 0;
                                },
                                'format' => ['decimal', 2],
                                'hAlign' => 'right',
                                'pageSummary' => true,
                                'pageSummaryFunc' => GridView::F_SUM
                            ],
                            [
                                'attribute' => 'commission_amount',
                                'contentOptions' => ['style' => 'text-align: right'],
                                'value' => function ($data) {
                                    //return number_format($data->commission_amount != null ? $data->commission_amount : 0, 2);
                                    return $data->commission_amount != null ? $data->commission_amount : 0;
                                },
                                'format' => ['decimal', 2],
                                'hAlign' => 'right',
                                'pageSummary' => true,
                                'pageSummaryFunc' => GridView::F_SUM
                            ],
                            [
                                'attribute' => 'remark',
                                'value' => function ($data) {
                                    return $data->remark != null ? $data->remark : '';
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
                                'template' => '{update}',
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
                                        return Html::a('<span class="fas fa-edit btn btn-xs btn-default"></span>', 'index.php?r=job/update&id=' . $data->id, $options);
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
                <?php endif; ?>

            </div>
        <?php endif; ?>

    </div>
    <br/>
<?php if (!$model->isNewRecord && $dataProvider->getTotalCount() > 0): ?>
    <form action="<?= Url::to(['jobmain/createjobstdcom'], true) ?>" method="post">
        <div class="row">
            <div class="col-lg-6">

                <input type="hidden" name="current_job_main_id" value="<?= $model->id ?>">
                <table class="table table-bordered" id="table-commission">
                    <thead>
                    <tr>
                        <th style="text-align: right;">Total Profit</th>
                        <th style="text-align: right;width: 20%">%Commission</th>
                        <th style="text-align: right;">Total Commission</th>
                        <!--                        <th></th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total_profit_amount = 0;
                    $total_commission_amount = 0;
                    ?>
                    <?php if ($model_job_main_com_std): ?>
                        <?php foreach ($model_job_main_com_std as $value): ?>
                            <?php
                                $total_profit_amount = ($value->std_amount + $total_profit_amount);
                                $total_commission_amount = ($value->commission_amount + $total_commission_amount);
                            ?>
                            <tr>
                                <td style="padding: 0;"><input type="text" style="border: none;text-align: right;"
                                                               class="form-control line-profit-std-amt"
                                                               value="<?= number_format($value->std_amount, 2) ?>"
                                                               name="line_profit_std_amt[]"
                                                               onchange="cal_profit_std($(this))">
                                </td>
                                <td style="padding: 0;"><input type="text" style="border: none;text-align:right;"
                                                               class="form-control line-profit-std-com-per"
                                                               value="<?= number_format($value->commission_per, 2) ?>"
                                                               name="line_profit_std_com_per[]"
                                                               onchange="cal_profit_std($(this))"></td>
                                <td style="padding: 0;"><input type="text" style="border: none;text-align: right;"
                                                               class="form-control line-profit-std-total-amt"
                                                               value="<?= number_format($value->commission_amount, 2) ?>"
                                                               name="line_profit_std_total_amt[]" readonly></td>
                                <!--                                <td style="padding: 0.1em;">-->
                                <!--                                    <div class="btn btn-sm btn-danger">-</div>-->
                                <!--                                </td>-->
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>

                        <?php
                        $line_for_com_profit = 0;
                        $total_profit_amount = getSummaryprofitamount2($model->id);
                        $profit_loop = 0;
                        $std_comission_per = [3,4,5,6,7,8,9,10];
                        $acumulated_com_amount = $total_profit_amount;
                        if ($total_profit_amount > 0) {
                            $profit_loop = $total_profit_amount / 100000;
                        }
                        echo "loop is " . round($profit_loop); ?>
                        ?>
                        <?php if ($profit_loop > 0): ?>
                            <?php for ($a = 0; $a <= $profit_loop; $a++): ?>
                            <?php
                                $lint_cal_total_com_amount = (100000 * $std_comission_per[$a]) / 100;
                                //$acumulated_com_amount = ($acumulated_com_amount - 100000);
                                $std_separate_amount = 100000;
                                if($acumulated_com_amount < 100000){
                                    $lint_cal_total_com_amount = ($acumulated_com_amount * $std_comission_per[$a]) / 100;
                                    $std_separate_amount = $acumulated_com_amount;
                                }
                                $total_commission_amount = ($total_commission_amount + $lint_cal_total_com_amount);
                                ?>
                                <tr>
                                    <td style="padding: 0;"><input type="text" style="border: none;text-align: right;"
                                                                   class="form-control line-profit-std-amt"
                                                                   value="<?= number_format($std_separate_amount, 1) ?>"
                                                                   name="line_profit_std_amt[]"
                                                                   onchange="cal_profit_std($(this))">
                                    </td>
                                    <td style="padding: 0;"><input type="text" style="border: none;text-align:right;"
                                                                   class="form-control line-profit-std-com-per"
                                                                   value="<?=number_format($std_comission_per[$a], 2)?>"
                                                                   name="line_profit_std_com_per[]"
                                                                   onchange="cal_profit_std($(this))"></td>
                                    <td style="padding: 0;"><input type="text" style="border: none;text-align: right;"
                                                                   class="form-control line-profit-std-total-amt"
                                                                   value="<?= number_format($lint_cal_total_com_amount, 2) ?>"
                                                                   name="line_profit_std_total_amt[]" readonly></td>
                                    <!--                            <td style="padding: 0.1em;">-->
                                    <!--                                <div class="btn btn-sm btn-danger">-</div>-->
                                    <!--                            </td>-->
                                </tr>
                                <?php $acumulated_com_amount = ($acumulated_com_amount - 100000);?>
                            <?php endfor; ?>

                        <?php endif; ?>
                    <?php endif; ?>


                    </tbody>
                    <tfoot>
                    <?php
                    $sum_profit = 0;
                    $sum_profit_per = 0;
                    $sum_profit_amount = 0;
                    $sum_profit2 = 0;
                    $sum_profit_per2 = 0;
                    $sum_profit_amount2 = 0;
                    $total_achievement_amount = 0;
                    $pay_by_company = 0;
                    $pay_by_team_lead = 0;

                    if ($model_job_main_com_std_sum != null) {
                        if ($model_job_main_com_std_sum->std_amount > 0) {
                            $sum_profit = $model_job_main_com_std_sum->std_amount;
                            $sum_profit_per = $model_job_main_com_std_sum->commission_per;
                            $sum_profit_amount = $model_job_main_com_std_sum->commission_amount;
                        } else {
                            $sum_profit = getSummaryprofitamount($model->team_id, $model->job_month);
                        }

                    } else {
                        $sum_profit = getSummaryprofitamount($model->team_id, $model->job_month);
                    }

                    if ($model_job_main_com_std_sum_level_2 != null) {
                        $sum_profit2 = $model_job_main_com_std_sum_level_2->std_amount;
                        $sum_profit_per2 = $model_job_main_com_std_sum_level_2->commission_per;
                        $sum_profit_amount2 = $model_job_main_com_std_sum_level_2->commission_amount;
                    }

                    $total_achievement_amount = getAcheivementAmount($model->team_id,$model->job_month);
                    if ($total_achievement_amount != null) {
                        $pay_by_company = $total_achievement_amount / 2;
                        $pay_by_team_lead = $total_achievement_amount / 2;
                    }


                    ?>

                    <tr>
                        <td style="text-align: right;padding: 0;background-color: lightblue;">
                            <input type="text"
                                   style="border: none;text-align: right;background-color: lightblue;font-weight: bold;"
                                   class="form-control total-profit-summary-2" name="total_profit_summary_2"
                                   value="<?= number_format($total_profit_amount, 2) ?>" readonly>
                        </td>
                        <td style="padding: 0;"><input type="text"
                                                       style="border: none;text-align: right;background-color: lightblue;font-weight: bold;color: red;"
                                                       class="form-control total-profit-summary-per-2"
                                                       name="total_profit_summary_per_2"
                                                       value="<?= number_format(($total_commission_amount / $total_profit_amount)*100, 2) ?>"></td>
                        <td style="padding: 0;"><input type="text"
                                                       style="border: none;text-align: right;background-color: lightblue;font-weight: bold;color: red;"
                                                       class="form-control total-profit-summary-cal-2"
                                                       value="<?= number_format($total_commission_amount, 2) ?>"
                                                       name="total_profit_summary_cal_2" readonly></td>
                        <!--                        <td style="padding: 0;"></td>-->
                    </tr>
                    <tr>
                        <td style="text-align: right;padding: 0.2em;background-color: lightblue;"><b>Total Achievement
                                Reward:</b></td>
                        <td style="padding: 0;"><input type="text"
                                                       style="border: none;text-align: right;background-color: lightblue;"
                                                       class="form-control" name="x"
                                                       value="100" readonly></td>
                        <td style="padding: 0;"><input type="text"
                                                       style="border: none;text-align: right;background-color: lightblue;font-weight: bold;"
                                                       class="form-control line-profit-std-total-amtx"
                                                       value="<?= number_format($total_achievement_amount, 2) ?>"
                                                       name="line_profit_std_total_amt[]" readonly></td>
                        <!--                        <td style="padding: 0;"></td>-->
                    </tr>
                    <tr>
                        <td style="text-align: right;padding: 0.2em;background-color: lightblue;"><b>Extra Commission by
                                Company :</b></td>
                        <td style="padding: 0;"><input type="text"
                                                       style="border: none;text-align: right;background-color: lightblue;"
                                                       class="form-control" name="x"
                                                       value="50" readonly></td>
                        <td style="padding: 0;"><input type="text"
                                                       style="border: none;text-align: right;background-color: lightblue;font-weight: bold;"
                                                       class="form-control line-profit-std-total-amtx"
                                                       value="<?= number_format($pay_by_company, 2) ?>"
                                                       name="line_profit_std_total_amt[]" readonly></td>
                        <!--                        <td></td>-->
                    </tr>
                    <tr>
                        <td style="text-align: right;padding: 0.2em;background-color: lightblue;"><b>Extra Commission by
                                Team leader :</b></td>
                        <td style="padding: 0;"><input type="text"
                                                       style="border: none;text-align: right;background-color: lightblue;"
                                                       class="form-control" name="x"
                                                       value="50" readonly></td>
                        <td style="padding: 0;"><input type="text"
                                                       style="border: none;text-align: right;background-color: lightblue;font-weight: bold;"
                                                       class="form-control line-profit-std-total-amtx"
                                                       value="<?= number_format($pay_by_team_lead, 2) ?>"
                                                       name="line_profit_std_total_amt[]" readonly></td>
                        <!--                        <td></td>-->
                    </tr>
                    <tr>
                        <td style="text-align: right;padding: 0.2em;background-color: lightblue;"><b>Total Commission
                                :</b></td>
                        <td style="padding: 0;"><input type="text"
                                                       style="border: none;text-align: right;background-color: lightblue;"
                                                       class="form-control" name="x"
                                                       value="" readonly></td>
                        <td style="padding: 0;background-color: lightblue"><input type="text"
                                                                                  style="border: none;text-align: right;background-color: lightblue;font-weight: bold;"
                                                                                  class="form-control line-profit-std-grand-total"
                                                                                  value="<?= number_format($sum_profit_amount2 + $total_achievement_amount, 2) ?>"/> <!--number_format(getGrandTotalCommission($model->id) --
                                                                                  name="line_profit_std_grand_total"
                                                                                  readonly></td>
                        <!--                        <td></td>-->
                    </tr>
                    <tr>
                        <td colspan="2">
<!--                            <div class="btn btn-sm btn-primary">เพิ่มแถว</div>-->
                        </td>
                        <td colspan="2" style="text-align: right;">
                            <button class="btn btn-sm btn-warning">อัพเดทตาราง</button>
                        </td>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>
        <br/>

        <?php
        $team_line = \common\models\TeamLine::find()->where(['team_id' => $model->team_id])->andFilterWhere(['!=', 'is_head', 1])->orderBy(['id' => SORT_ASC])->all();
        ?>
        <div class="row">
            <div class="col-lg-6"><h5>Commission Sharing</h5></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered" id="table-share-commission">
                    <thead>
                    <tr>
                        <th style="background-color: #36ab63;width:15%;">Name</th>
                        <th style="background-color: #36ab63;width:10%;text-align: right;">%Commission</th>
                        <th style="background-color: #36ab63;width:10%;text-align: right;">Commission,std.</th>
                        <th style="background-color: #36ab63;width:10%;text-align: right;">TTAR</th>
                        <th style="background-color: #36ab63;width:10%;text-align: right;">PTAR</th>
                        <th style="background-color: #36ab63;width:10%;text-align: right;">PPR</th>
                        <th style="background-color: #36ab63;width:10%;text-align: right;">Total Commission</th>
                        <th style="background-color: #36ab63;width:10%;text-align: right;">Rebate/Campaign</th>
                        <th style="background-color: #36ab63;width:15%;text-align: right;">Grand Total Commission</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sum_line_share_per = 0;
                    $sum_line_share_amount = 0;
                    $sum_line_share_ttar = 0;
                    $sum_line_share_ptar = 0;
                    $sum_line_share_ppr = 0;
                    $sum_line_share_total = 0;
                    $sum_line_share_rebate = 0;
                    $sum_line_share_grand_total = 0;
                    if ($team_line) {

                        foreach ($team_line as $value):?>
                            <?php
                            $line_com_share_per = 0;
                            $line_com_share_amount = 0;
                            $line_com_share_ttar = 0;
                            $line_com_share_ptar = 0;
                            $line_com_share_ppr = 0;
                            $line_com_share_total = 0;
                            $line_com_share_rebate = 0;
                            $line_com_share_grand_total = 0;

                            $share_data = getEmpcomshare($value->emp_id, $model->id);
                            if ($share_data) {
                                $line_com_share_per = $share_data[0]['share_per'];
                                $line_com_share_amount = $share_data[0]['share_amount'];
                                $line_com_share_ttar = $share_data[0]['ttar_amount'];
                                $line_com_share_ptar = $share_data[0]['ptar_amount'];
                                $line_com_share_ppr = $share_data[0]['ppr_amount'];
                                $line_com_share_total = $share_data[0]['total_amount'];
                                $line_com_share_rebate = $share_data[0]['rebate_amount'];
                                $line_com_share_grand_total = $share_data[0]['grand_total_amount'];

                                $sum_line_share_per += $line_com_share_per;
                                $sum_line_share_amount += $line_com_share_amount;
                                $sum_line_share_ttar += $line_com_share_ttar;
                                $sum_line_share_ptar += $line_com_share_ptar;
                                $sum_line_share_ppr += $line_com_share_ppr;
                                $sum_line_share_total += $line_com_share_total;
                                $sum_line_share_rebate += $line_com_share_rebate;
                                $sum_line_share_grand_total += $line_com_share_grand_total;
                            }
                            ?>
                            <tr>
                                <td style="padding: 10px 0px 0px 5px;">
                                    <input type="hidden" class="line_com_share_emp_id" name="line_com_share_emp_id[]"
                                           value="<?= $value->emp_id ?>">
                                    <?= \backend\models\Employee::findFullName($value->emp_id) ?>
                                </td>
                                <td style="text-align: right;padding: 0px;">
                                    <input type="text" class="form-control line-com-share-per"
                                           style="height: 46px;border: none;text-align: right;"
                                           name="line_com_share_per[]"
                                           value="<?= number_format($line_com_share_per, 1) ?>"
                                           onchange="calsharecommission($(this))">
                                </td>
                                <td style="text-align: right;padding: 0px;">
                                    <input type="text" class="form-control line-com-share-amount"
                                           style="height: 46px;border: none;text-align: right;"
                                           name="line_com_share_amount[]"
                                           value="<?= number_format($line_com_share_amount, 2) ?>" readonly>
                                </td>
                                <td style="text-align: right;padding: 0px;">
                                    <input type="text" class="form-control line-com-share-ttar-amount"
                                           style="height: 46px;border: none;text-align: right;"
                                           name="line_com_share_ttar_amount[]"
                                           value="<?= number_format($line_com_share_ttar, 2) ?>" readonly>
                                </td>
                                <td style="text-align: right;padding: 0px;">
                                    <input type="text" class="form-control line-com-share-ptar-amount"
                                           style="height: 46px;border: none;text-align: right;"
                                           name="line_com_share_ptar_amount[]"
                                           value="<?= number_format($line_com_share_ptar, 2) ?>" readonly>
                                </td>
                                <td style="text-align: right;padding: 0px;">
                                    <input type="text" class="form-control line-com-share-ppr-amount"
                                           style="height: 46px;border: none;text-align: right;"
                                           name="line_com_share_ppr_amount[]"
                                           value="<?= number_format($line_com_share_ppr, 2) ?>" readonly>
                                </td>
                                <td style="text-align: right;padding: 0px;">
                                    <input type="text" class="form-control line-com-share-total-amount"
                                           style="height: 46px;border: none;text-align: right;"
                                           name="line_com_share_total_amount[]"
                                           value="<?= number_format($line_com_share_total, 2) ?>" readonly>
                                </td>
                                <td style="text-align: right;padding: 0px;">
                                    <input type="text" class="form-control line-com-share-rebate-amount"
                                           style="height: 46px;border: none;text-align: right;"
                                           name="line_com_share_rebate_amount[]"
                                           value="<?= number_format($line_com_share_rebate, 2) ?>" readonly>
                                </td>
                                <td style="text-align: right;padding: 0px;">
                                    <input type="text" class="form-control line-com-share-grand-total-amount"
                                           style="height: 46px;border: none;text-align: right;font-weight: bold;color: red;"
                                           name="line_com_share_grand_total_amount[]"
                                           value="<?= number_format($line_com_share_grand_total, 2) ?>" readonly>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td style="text-align: right;background-color: lightblue;padding-top: 20px;"><b>รวม</b></td>
                        <td style="background-color: lightblue;">
                            <input type="text" class="form-control line-com-share-per-sum"
                                   style="height: 46px;border: none;text-align: right;font-weight: bold;color: red;"
                                   name="line_com_share_per_sum[]"
                                   value="<?= number_format($sum_line_share_per, 1) ?>" readonly>
                        </td>
                        <td style="background-color: lightblue;">
                            <input type="text" class="form-control line-com-share-amount-sum"
                                   style="height: 46px;border: none;text-align: right;font-weight: bold"
                                   name="line_com_share_amount_sum[]"
                                   value="<?= number_format($sum_line_share_amount, 2) ?>" readonly>
                        </td>
                        <td style="background-color: lightblue;">
                            <input type="text" class="form-control line-com-share-ttar-amount-sum"
                                   style="height: 46px;border: none;text-align: right;font-weight: bold"
                                   name="line_com_share_ttar_amount_sum[]"
                                   value="<?= number_format($sum_line_share_ttar, 2) ?>" readonly>
                        </td>
                        <td style="background-color: lightblue;">
                            <input type="text" class="form-control line-com-share-ptar-amount-sum"
                                   style="height: 46px;border: none;text-align: right;font-weight: bold"
                                   name="line_com_share_ptar_amount_sum[]"
                                   value="<?= number_format($sum_line_share_ptar, 2) ?>" readonly>
                        </td>
                        <td style="background-color: lightblue;">
                            <input type="text" class="form-control line-com-share-ppr-amount-sum"
                                   style="height: 46px;border: none;text-align: right;font-weight: bold"
                                   name="line_com_share_ppr_amount_sum[]"
                                   value="<?= number_format($sum_line_share_ppr, 2) ?>" readonly>
                        </td>
                        <td style="background-color: lightblue;">
                            <input type="text" class="form-control line-com-share-total-amount-sum"
                                   style="height: 46px;border: none;text-align: right;font-weight: bold"
                                   name="line_com_share_total_amount_sum[]"
                                   value="<?= number_format($sum_line_share_total, 2) ?>" readonly>
                        </td>
                        <td style="background-color: lightblue;">
                            <input type="text" class="form-control line-com-share-rebate-amount-sum"
                                   style="height: 46px;border: none;text-align: right;font-weight: bold"
                                   name="line_com_share_rebate_amount_sum[]"
                                   value="<?= number_format($sum_line_share_rebate, 2) ?>" readonly>
                        </td>
                        <td style="background-color: lightblue;">
                            <input type="text" class="form-control line-com-share-grand-total-amount-sum"
                                   style="height: 46px;border: none;text-align: right;font-weight: bold;color: red;"
                                   name="line_com_share_grand_total_amount_sum[]"
                                   value="<?= number_format($sum_line_share_grand_total, 2) ?>" readonly>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </form>

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
<?php endif; ?>
<?php
function getSummaryprofitamount($team_id, $trans_date)
{
    $total = 0;
    $month = date('m', strtotime($trans_date));
    $year = date('Y', strtotime($trans_date));
    if ($team_id != null && $month != null && $year != null) {
        $model = \common\models\Job::find()->select(['job_benefit_amount'])->where(['team_id' => $team_id, 'month(trans_date)' => $month, 'year(trans_date)' => $year])->all();
        if ($model) {
            foreach ($model as $value) {
                $total += $value->job_benefit_amount;
            }
        }
    }
    return $total;
}

function getSummaryprofitamount2($job_master_id)
{
    $total = 0;
    if ($job_master_id) {
        $model = \common\models\Job::find()->select(['job_benefit_amount'])->where(['job_master_id' => $job_master_id])->all();
        if ($model) {
            foreach ($model as $value) {
                $total += $value->job_benefit_amount;
            }
        }
    }
    return $total;
}

function getGrandTotalCommission($job_main_id)
{
    $total = 0;
    if ($job_main_id != null) {
        $model = \common\models\JobMaster::find()->select(['total_commission_amount'])->where(['id' => $job_main_id])->one();
        if ($model) {
            $total = $model->total_commission_amount;
        }
    }
    return $total;
}

function getGrandTotalCommissionLevel2($job_main_id)
{
    $total = 0;
    if ($job_main_id != null) {
        $model = \common\models\JobProfitComStd::find()->select(['commission_amount'])->where(['job_id' => $job_main_id, 'type_id' => 1])->one();
        if ($model) {
            $total = $model->commission_amount;
        }
    }
    return $total;
}

function getAcheivementAmount($team_id,$trans_date)
{
    $total = 0;
      $month = date('m', strtotime($trans_date));
      $year = date('Y', strtotime($trans_date));
    if ($team_id != null && $month != null && $year != null) {
        $model_target_year = \common\models\TeamTargetYear::find()->select(['id'])->where(['target_year' => $year, 'team_id' => $team_id])->one();
        if ($model_target_year) {
            $model_target_com = \common\models\TeamExtraCom::find()->select(['id'])->where(['target_year_id' => $model_target_year->id])->one();
            if ($model_target_com) {
               $model_target_team_extra = \common\models\TeamExtraComLine::find()->where(['team_extra_com_id' => $model_target_com->id])->sum('sum_total');
               if($model_target_team_extra){
                   $total = $model_target_team_extra;
               }
            }
        }
//        $model = \common\models\TeamExtraComLine::find()->where(['team_id' => $team_id, 'month' => $month, 'year' => $year])->sum('sum_total');
//        if ($model) {
//            $total = $model;
//        }
    }
    return $total;
}

function getEmpcomshare($emp_id, $job_main_id)
{
    $data = [];
    if ($emp_id != null && $job_main_id != null) {
        $model = \common\models\JobComShare::find()->where(['emp_id' => $emp_id, 'job_id' => $job_main_id])->one();
        if ($model) {
            array_push($data, [
                'share_per' => $model->share_per,
                'share_amount' => $model->share_amount,
                'ttar_amount' => $model->ttar_amount,
                'ptar_amount' => $model->ptar_amount,
                'ppr_amount' => $model->ppr_amount,
                'total_amount' => $model->total_amount,
                'rebate_amount' => $model->rebate_amount,
                'grand_total_amount' => $model->grand_total,
            ]);
        }
    }
    return $data;
}

?>
<?php
$url_to_find_employee = \yii\helpers\Url::to(['job/getemployee'], true);
$url_to_add_job = \yii\helpers\Url::to(['jobmain/createjob'], true);
$url_to_check_quot_dup = \yii\helpers\Url::to(['jobmain/checkdup'], true);
$url_to_create_customer = \yii\helpers\Url::to(['advancetable/createcustomer'], true);
$js = <<<JS
var selecteditem = [];
var removelist = [];
$(function(){
   let tags = []; // Array to store tags
   let tags2 = []; // Array to store tags
   
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
            
            if(checkdupQuotation(value) == 100){
                alert("ใบเสนอราคาซ้ำในระบบ");
                input.val('');
                return false;
            }

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
    var customer_id = $("#selected-customer-id").val();
    var tags = $("#hiddenTags").val();
    var tags2 = $("#hiddenInvoiceTags").val();
    var team_id = $("#team-id").val();
    var head_id = $("#head-id").val();
    var emp_sale_id = $("#emp-sale-id").val();
    //alert(jobmain_id);
    //alert(customer_id);
   
    if(jobmain_id && customer_id){
      //   alert(team_id);
        $.ajax({
        url: url,
        type: 'post',
        dataType: 'html',
        data: {id: jobmain_id,customer_id:customer_id,tags:tags,tags2:tags2,team_id:team_id,head_id:head_id,emp_sale_id:emp_sale_id},
        success: function (data) {
           //alert('ok');
          // window.location.reload();
        },
        error: function (err) {
           // alert('error');
        }
    });
    }
    
}

function cal_profit_std(e){
    var line_profit_std = e.closest('tr').find(".line-profit-std-amt").val().replace(",","");
    var line_profit_commission_rate = e.closest('tr').find(".line-profit-std-com-per").val().replace(",","");
    //alert(line_profit_std);
    var line_total = (parseFloat(line_profit_std) * parseFloat(line_profit_commission_rate)) / 100;
    e.closest('tr').find(".line-profit-std-total-amt").val(parseFloat(line_total).toFixed(2));
    
  //  cal_profit_std();
   var sum = 0;
   var sum_line_total = 0;
   $("table#table-commission tbody tr").each(function(){
        sum += parseFloat($(this).find(".line-profit-std-amt").val().replace(",",""));
        sum_line_total += parseFloat($(this).find(".line-profit-std-total-amt").val().replace(",",""));
    });
   
   $(".total-profit-summary-2").val(parseFloat(sum).toFixed(2).toLocaleString("en"));
   $(".total-profit-summary-cal-2").val(parseFloat(sum_line_total).toFixed(2).toLocaleString("en"));
}

function calProfitsum(){
    var sum = 0;
    var sum_line_total = 0;
    var sum_all_line_total = 0;
    var sum_before_grand = 0;
    var sum_per_cal = 0;
    var total_profit = $(".total-profit-summary").val().replace(",","");
    var total_profit_per = $(".total-profit-summary-per").val().replace(",","");
    var total_profit_cal = (parseFloat(total_profit) * parseFloat(total_profit_per))/100;
    $(".total-profit-summary-cal").val(parseFloat(total_profit_cal).toFixed(2));
    
    $(".total-profit-summary-per").val(parseFloat(total_profit_per).toFixed(2));
    
    
    $("table#table-commission tbody tr").each(function(){
        sum += parseFloat($(this).find(".line-profit-std-amt").val().replace(",",""));
        sum_line_total += parseFloat($(this).find(".line-profit-std-total-amt").val().replace(",",""));
    });
    
    sum_before_grand = parseFloat(sum) + parseFloat(total_profit);
    sum_all_line_total = parseFloat(sum_line_total) + parseFloat(total_profit_cal);
    
    sum_per_cal = (sum_all_line_total / sum_before_grand) * 100;
    
    $(".total-profit-summary-2").val(parseFloat(sum_before_grand).toFixed(2).toLocaleString("en"));
    $(".total-profit-summary-cal-2").val(parseFloat(sum_all_line_total).toFixed(2).toLocaleString("en"));
    $(".total-profit-summary-per-2").val(parseFloat(sum_per_cal).toFixed(2));
    
    $(".line-profit-std-grand-total").val(parseFloat(sum_all_line_total).toFixed(2));
    
}

function calsharecommission(e){
    var line_com_share_amount = 0;
    
    var sum_line_com_share_per = 0
    var sum_line_com_share_amount = 0;
    var sum_line_com_share_ttar_amount = 0;
    var sum_line_com_share_ptar_amount = 0;
    var sum_line_com_share_ppr_amount = 0;
    var sum_line_com_share_total_amount = 0;
    var sum_line_com_share_rebate_amount = 0;
    var sum_line_com_share_grand_total_amount = 0;

    
    var grand_total_for_cal = $(".line-profit-std-grand-total").val().replace(",","");
    var line_com_share_per = e.val();
    
    line_com_share_amount = (parseFloat(grand_total_for_cal) * parseFloat(line_com_share_per)) / 100;
    
    e.closest("tr").find(".line-com-share-amount").val(parseFloat(line_com_share_amount).toFixed(2));
    e.closest("tr").find(".line-com-share-total-amount").val(parseFloat(line_com_share_amount).toFixed(2));
    e.closest("tr").find(".line-com-share-grand-total-amount").val(parseFloat(line_com_share_amount).toFixed(2));
    
    calsharecommissionsum();
    
}
function calsharecommissionsum(){
    var sum_line_com_share_per = 0
    var sum_line_com_share_amount = 0;
    var sum_line_com_share_ttar_amount = 0;
    var sum_line_com_share_ptar_amount = 0;
    var sum_line_com_share_ppr_amount = 0;
    var sum_line_com_share_total_amount = 0;
    var sum_line_com_share_rebate_amount = 0;
    var sum_line_com_share_grand_total_amount = 0;
    
    $("table#table-share-commission tbody tr").each(function(){
        var line_com_share_per = $(this).find(".line-com-share-per").val().replace(",","");
        var line_com_share_amount = $(this).find(".line-com-share-amount").val().replace(",","");
        var line_com_share_ttar_amount = $(this).find(".line-com-share-ttar-amount").val().replace(",","");
        var line_com_share_ptar_amount = $(this).find(".line-com-share-ptar-amount").val().replace(",","");
        var line_com_share_ppr_amount = $(this).find(".line-com-share-ppr-amount").val().replace(",","");
        var line_com_share_total_amount = $(this).find(".line-com-share-total-amount").val().replace(",","");
        var line_com_share_rebate_amount = $(this).find(".line-com-share-rebate-amount").val().replace(",","");
        var line_com_share_grand_total_amount = $(this).find(".line-com-share-grand-total-amount").val().replace(",","");
        
        sum_line_com_share_per += parseFloat(line_com_share_per);
        sum_line_com_share_amount += parseFloat(line_com_share_amount);
        sum_line_com_share_ttar_amount += parseFloat(line_com_share_ttar_amount);
        sum_line_com_share_ptar_amount += parseFloat(line_com_share_ptar_amount);
        sum_line_com_share_ppr_amount += parseFloat(line_com_share_ppr_amount);
        sum_line_com_share_total_amount += parseFloat(line_com_share_total_amount);
        sum_line_com_share_rebate_amount += parseFloat(line_com_share_rebate_amount);
        sum_line_com_share_grand_total_amount += parseFloat(line_com_share_grand_total_amount);
    });
    
    $(".line-com-share-per-sum").val(parseFloat(sum_line_com_share_per).toFixed(2));
    $(".line-com-share-amount-sum").val(parseFloat(sum_line_com_share_amount).toFixed(2));
    $(".line-com-share-ttar-amount-sum").val(parseFloat(sum_line_com_share_ttar_amount).toFixed(2));
    $(".line-com-share-ptar-amount-sum").val(parseFloat(sum_line_com_share_ptar_amount).toFixed(2));
    $(".line-com-share-ppr-amount-sum").val(parseFloat(sum_line_com_share_ppr_amount).toFixed(2));    
    $(".line-com-share-total-amount-sum").val(parseFloat(sum_line_com_share_total_amount).toFixed(2));
    $(".line-com-share-rebate-amount-sum").val(parseFloat(sum_line_com_share_rebate_amount).toFixed(2));
    $(".line-com-share-grand-total-amount-sum").val(parseFloat(sum_line_com_share_grand_total_amount).toFixed(2));
    
}

function checkdupQuotation(quot_no){
    var res = 0;
    if(quot_no != null){
        $.ajax({
            url: '$url_to_check_quot_dup',
            type: 'post',
            dataType: 'html',
            async: false,
            data: {'quot_no': quot_no},
            success: function (data) {
                res = data;
              // alert(data);
              // window.location.reload();
            },
            error: function (err) {
                //alert('error');
                res = 0;
            }
        });
    }
    
    return res;
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
                
                // $("#selected-unit-id").append('<option value="'+data+'">'+unit_name+'</option>');
                // $("#selected-unit-id").val(data).change();
                if(data != '' || data != null){
                    if(data == 'duplicate'){
                        $(".name-validate").html("ชื่อลูกค้าซ้ำในระบบ").show();
                    }else{
                        $(".name-validate").hide();
                        $("#selected-customer-id").html(data);
                        $(".new-customer-name").val('');
                        $(".new-customer-description").val('');
                        $("#createCustomerModal").modal("hide");
                    }
                     
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

JS;

$this->registerJs($js, static::POS_END);

?>