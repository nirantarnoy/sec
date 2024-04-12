<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Customerinvoice $model */

$this->title = $model->invoice_no;
$this->params['breadcrumbs'][] = ['label' => 'วางบิล', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customerinvoice-view">

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
        //    'id',
            'invoice_no',
            'invoice_date',
            'invoice_target_date',
            [
                'attribute' => 'sale_id',
                'value' => function ($data) {
                    return \backend\models\Employee::findFullName($data->sale_id);
                }
            ],
            'work_name',
            [
                'attribute' => 'customer_id',
                'value' => function ($data) {
                    return \backend\models\Customer::findCusName($data->customer_id);
                }
            ],
            'total_amount',
            'vat_amount',
            'vat_per',
            'total_all_amount',
            'total_text',
            'final_amount',
            'remark',
            'remark2',
            'create_at',
            'created_by',
            'updated_at',
            'updated_by',
            'status',
            'customer_extend_remark',
            'company_extend_remark',
        ],
    ]) ?>

</div>
