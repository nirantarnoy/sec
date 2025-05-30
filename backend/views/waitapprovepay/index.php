<?php

use backend\models\Job;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\JobSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ใบงานรออนุมัติจ่าย';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-index">
    <?php if (\Yii::$app->session->getFlash('success') !== null): ?>
        <div class="alert alert-success">
            <?= \Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <?php Pjax::begin(); ?>
    <div class="row">
        <div class="col-lg-10">
            <p>
                <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> สร้างใหม่'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="col-lg-2" style="text-align: right">
            <form id="form-perpage" class="form-inline" action="<?= Url::to(['warehouse/index'], true) ?>"
                  method="post">
                <div class="form-group">
                    <label>แสดง </label>
                    <select class="form-control" name="perpage" id="perpage">
                        <option value="20" <?= $perpage == '20' ? 'selected' : '' ?>>20</option>
                        <option value="50" <?= $perpage == '50' ? 'selected' : '' ?> >50</option>
                        <option value="100" <?= $perpage == '100' ? 'selected' : '' ?>>100</option>
                    </select>
                    <label> รายการ</label>
                </div>
            </form>
        </div>
    </div>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

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
        //'responsiveWrap' => true,
        //'tableOptions' => ['class' => 'table table-responsive table-hover'],
        'emptyText' => '<div style="color: red;text-align: center;"> <b>ไม่พบรายการไดๆ</b> <span> เพิ่มรายการโดยการคลิกที่ปุ่ม </span><span class="text-success">"สร้างใหม่"</span></div>',
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'text-align: center'],
                'contentOptions' => ['style' => 'text-align: center']],
            'job_no',
            'quotation_ref_no',
            [
                'attribute' => 'trans_date',
                'value' => function ($data) {
                    return $data->trans_date != null ? date('d-m-Y', strtotime($data->trans_date)) : '';
                }
            ],
            [
                'attribute' => 'customer_id',
                'value' => function ($data) {
                    return \backend\models\Customer::findCusFullName($data->customer_id);
                }
            ],
            [
                'attribute' => 'team_id',
                'value' => function ($data) {
                    return \backend\models\Team::findName($data->team_id);
                }
            ],
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
                'template' => '{view}{approve}',
                'buttons' => [
                    'view' => function ($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'View'),
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'id' => 'modaledit',
                        ]);
                        return Html::a(
                            '<span class="fas fa-eye btn btn-xs btn-default"></span>', $url, [
                            'id' => 'activity-view-link',
                            //'data-toggle' => 'modal',
                            // 'data-target' => '#modal',
                            'data-id' => $index,
                            'data-pjax' => '0',
                            // 'style'=>['float'=>'rigth'],
                        ]);
                    },
                    'approve' => function ($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Approve'),
                            'aria-label' => Yii::t('yii', 'Approve'),
                            //'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            //'data-method' => 'post',
                            //'data-pjax' => '0',
                            'data-url' => $url,
                            'data-var' => $data->id,
                            'onclick' => 'approvePay($(this));'
                        ]);
                        return Html::a('<span class="fas fa-check-circle btn btn-xs btn-default"></span>', 'javascript:void(0)', $options);
                    }
                ]
            ],
        ],
        'pager' => ['class' => LinkPager::className()],
    ]); ?>

    <?php Pjax::end(); ?>

</div>