<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Carloantrans $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'บันทึกชำระค่างวด', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="carloantrans-view">

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
            [
                'attribute' => 'car_loan_id',
                'value' => function ($data) {
                    return \backend\models\Car::findName($data->car_loan_id);
                }
            ],
            [
                'attribute' => 'trans_date',
                'value' => function ($data) {
                    return date('d-m-Y', strtotime($data->trans_date));
                }
            ],
            'period_no',
            'loan_pay_amt',
           // 'status',
            'doc',
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
