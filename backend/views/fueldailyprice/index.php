<?php

use backend\models\Fueldailyprice;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\FueldailypriceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ราคาน้ำมันประจำวัน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fueldailyprice-index">
    <div class="row">
        <div class="col-lg-12">
            <?php if(!empty(\Yii::$app->session->getFlash('success'))):?>
                <input type="hidden" class="has-success" value="1">
            <div class="alert alert-success alert-after-save" style="padding: 25px;">
                <?php echo \Yii::$app->session->getFlash('success')?>
            </div>
            <?php endif;?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10">
<!--            <form action="--><?//=Url::to(['fueldailyprice/updateall'],true)?><!--" method="post">-->
            <p>
                <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> สร้างใหม่'), ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('app', '<i class="fa fa-upload"></i> อัพเดทราคาน้ำมันวันนี้'), ['updateall'], ['class' => 'btn btn-warning']) ?>
            </p>
<!--            </form>-->
        </div>
        <div class="col-lg-2" style="text-align: right">
            <form id="form-perpage" class="form-inline" action="<?= Url::to(['fueldailyprice/index'], true) ?>"
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

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
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
            ['class' => 'yii\grid\SerialColumn'],

            //  'id',
//            'fuel_id',
            [
                'attribute' => 'fuel_id',
                'value' => function ($data) {
                    return \backend\models\Fuel::findName($data->fuel_id);
                }
            ],
//            'province_id',
            [
                'attribute' => 'province_id',
                'value' => function ($data) {
                    return \backend\models\Province::findProvinceName($data->province_id);
                }
            ],
            // 'city_id',
            [
                'attribute' => 'car_type_id',
                'label' => 'ประเภทรถ',
                'value' => function ($data) {
                    return \backend\models\CarType::findName($data->car_type_id);
                }
            ],

            [
                'attribute' => 'price_date',
                'value' => function ($data) {
                    return date('d-m-Y', strtotime($data->price_date));
                }
            ],
            'price',
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
                        return Html::a(
                            '<span class="fas fa-edit btn btn-xs btn-default"></span>', $url, [
                            'id' => 'activity-view-link',
                            //'data-toggle' => 'modal',
                            // 'data-target' => '#modal',
                            'data-id' => $index,
                            'data-pjax' => '0',
                            // 'style'=>['float'=>'rigth'],
                        ]);
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
<?php
$js=<<<JS
if($(".has-success").val() == 1){
    setTimeout(function(){
        $(".alert-after-save").hide();
    },5000);
    
}

JS;
$this->registerJs($js,static::POS_END);
?>