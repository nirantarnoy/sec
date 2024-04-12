<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Quotationtitle $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'เสนอราคา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="quotationtitle-view">

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
            'name',
            'description',
            [
                'attribute' => 'created_at',
                'value' => function ($data) {
                    return date('d-m-Y H:m:i',$data->created_at);
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
                    return date('d-m-Y H:m:i',$data->updated_at);
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
