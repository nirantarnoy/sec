<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Purch */

$this->title = $model->purch_no;
$this->params['breadcrumbs'][] = ['label' => 'ใบสั่งซ์้อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="purch-view">
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
            //'id',
            'purch_no',
            'purch_date',
            [
                'attribute' => 'vendor_id',
                'value' => function ($data) {
                    return \backend\models\Vendor::findName($data->vendor_id);
                }
            ],
            [
                'attribute' => 'payment_term_id',
                'value' => function ($data) {
                    return \backend\models\Paymentterm::findName($data->payment_term_id);
                }
            ],
            'note',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'headerOptions' => ['style' => 'text-align: left'],
                'contentOptions' => ['style' => 'text-align: left'],
                'value' => function ($data) {
                    if ($data->status == 1) {
                        return '<div class="badge badge-success">Open</div>';
                    } else {
                        return '<div class="badge badge-secondary">' . \backend\helpers\PurchStatus::getTypeById($data->status) . '</div>';
                    }
                }
            ],
            ['attribute' => 'created_at', 'value' => function ($data) {
                return date('d/m/Y H:i:s', $data->created_at);
            }],
            [
                'attribute' => 'created_by',
                'value' => function ($data) {
                    return \backend\models\User::findName($data->created_by);
                }
            ],
            ['attribute' => 'updated_at', 'value' => function ($data) {
                return date('d/m/Y H:i:s', $data->updated_at);
            }],
            [
                'attribute' => 'updated_by',
                'value' => function ($data) {
                    return \backend\models\User::findName($data->updated_by);
                }
            ],
        ],
    ]) ?>

</div>
