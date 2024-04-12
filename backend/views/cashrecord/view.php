<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Cashrecord $model */

$this->title = $model->journal_no;
$this->params['breadcrumbs'][] = ['label' => 'Cashrecords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cashrecord-view">


    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
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
//            'id',
            'journal_no',
            'trans_date',
//            'car_id',
            [
                'attribute' => 'car_id',
                'value' => function ($data) {
                    return \backend\models\Car::findName($data->car_id);
                }
            ],
//            'car_tail_id',
            [
                'attribute' => 'car_tail_id',
                'value' => function ($data) {
                    return \backend\models\Car::findName($data->car_tail_id);
                }
            ],
//            'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->status == 1) {
                        return '<div class="badge badge-success" >ใช้งาน</div>';
                    } else {
                        return '<div class="badge badge-secondary" >ไม่ใช้งาน</div>';
                    }
                }
            ],
//            'created_at',
//            'create_by',
//            'updated_at',
//            'updated_by',
        ],
    ]) ?>

</div>
