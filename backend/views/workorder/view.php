<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Workorder $model */

$this->title = $model->workorder_no;
$this->params['breadcrumbs'][] = ['label' => 'ใบแจ้งซ่อม', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="workorder-view">

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
            // 'id',
            [
                'attribute' => 'trans_date',
                'value' => function ($data) {
                    return date('d-m-Y', strtotime($data->trans_date));
                }
            ],
            'workorder_no',
            [
                'attribute' => 'emp_inform_id',
                'value' => function ($data) {
                    return \backend\models\Employee::findFullName($data->emp_inform_id);
                }
            ],
            [
                'attribute' => 'car_id',
                'value' => function ($data) {
                    return \backend\models\Car::findName($data->car_id);
                }
            ],
            'mile_data',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return \backend\helpers\WorkorderStatus::getTypeById($data->status);
                }
            ],
            'is_other',
            'other_text',
            [
                'attribute' => 'approval_emp_id',
                'value' => function ($data) {
                    return \backend\models\Employee::findFullName($data->approval_emp_id);
                }
            ],
            [
                'attribute' => 'emp_notify_id',
                'value' => function ($data) {
                    return \backend\models\Employee::findFullName($data->emp_notify_id);
                }
            ],
            'car_type_id',
        ],
    ]) ?>

</div>
