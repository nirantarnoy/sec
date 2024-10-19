<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Quotation $model */

$this->title = $model->quotation_no;
$this->params['breadcrumbs'][] = ['label' => 'ใบเสนอราคา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="quotation-view">

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
            'quotation_no',
            'quotation_date',
            [
                'attribute' => 'quotation_date',
                'value' => function ($model) {
                    return date('d-m-Y', strtotime($model->quotation_date));
                }
            ],
            [
                'attribute' => 'customer_id',
                'value' => function ($model) {
                    return \backend\models\Customer::findCusFullName($model->customer_id);
                }
            ],
            'attn',
            //'from',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return \backend\helpers\QuotationStatus::getTypeById($model->status);
                }
            ],
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
            'remark',
            'description',
        ],
    ]) ?>

</div>
