<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Jobmain $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jobmains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="jobmain-view">

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
            //     'id',
            [
                'attribute' => 'team_id',
                'value' => function ($data) {
                    return \backend\models\Team::findName($data->team_id);
                }
            ],
            [
                'attribute' => 'emp_id',
                'value' => function ($data) {
                    return \backend\models\Employee::findFullName($data->emp_id);
                }
            ],
            'job_month',
            [
                    'attribute' => 'approve_payment_status',
                    'value' => function ($data) {
                        return \backend\helpers\JobApprovePaymentStatus::getTypeById($data->approve_payment_status);
                    }
            ],
            //'status',
            [
                'attribute' => 'created_at',
                'value' => function ($data) {
                    return date('d-m-Y H:i:s', $data->created_at);
                }
            ],
            [
                'attribute' => 'created_by',
                'value' => function ($data) {
                    return \backend\models\User::findName($data->created_by);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($data) {
                    return date('d-m-Y H:i:s', $data->updated_at);
                }
            ],
            [
                'attribute' => 'updated_by',
                'value' => function ($data) {
                    return \backend\models\User::findName($data->updated_by);
                }
            ],
        ],
    ]) ?>

</div>
