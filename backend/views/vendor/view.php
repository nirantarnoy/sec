<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Vendor */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ผู้ขาย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vendor-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //  'id',
            'code',
            'name',
//            ['attribute' => 'vendor_group_id',
//                'value' => function ($data) {
//                    return \backend\models\Vendorgroup::findName($data->vendor_group_id);
//                }
//            ],
            'description',
            ['attribute' => 'payment_method_id',
                'value' => function ($data) {
                    return \backend\models\Paymentmethod::findName($data->payment_method_id);
                }
            ],
            ['attribute' => 'payment_term_id',
                'value' => function ($data) {
                    return \backend\models\Paymentterm::findName($data->payment_term_id);
                }
            ],
            'location',
            'phone',
            'email',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'label'=>'สถานะ',
                'headerOptions' => ['style' => 'text-align: left'],
                'contentOptions' => ['style' => 'text-align: left'],
                'value' => function ($data) {
                    if ($data->status == 1) {
                        return '<div class="badge badge-success">ใช้งาน</div>';
                    } else {
                        return '<div class="badge badge-dark">ไม่ใช้งาน</div>';
                    }
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($data) {
                    return date('d-m-Y H:i:s', $data->created_at);
                }
            ],
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
        ],
    ]) ?>

</div>
