<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Cityzone $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'โซนพื้นที่', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cityzone-view">

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

    <div class="row">
        <div class="col-lg-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'id',
                    'name',
                    [
                        'attribute' => 'province_id',
                        'value' => function ($data) {
                            return \backend\models\Province::findProvinceName($data->province_id);
                        }
                    ],
                    [
                        'attribute' => 'เขต/อำเภอ',
                        'value' => function ($data) {
                           return \backend\models\Amphur::findCityzone($data->id);
                        }
                    ],
                ],
            ]) ?>
        </div>
    </div>


</div>
