<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Customer $model */

$model_contact_data = \common\models\ContactInfo::find()->where(['party_id' => $model->id])->all();

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customer-view">


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
            'code',
            'name',
            'business_type',
//            'status',
//            'district';
        ],
    ]) ?>
    <div class="row">
        <div class="col-lg-4">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'phone'
                ],
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'email'
                ],
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => 'บริษัท',
                        'value' => function ($data) {
                            return \backend\models\Company::findCompanyName($data->company_id);
                        }
                    ]

                ],
            ]) ?>
        </div>
    </div>

    <!--    <div class="row">-->
    <div class="row">
        <div class="col-lg-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'address',
                        'label' => 'ที่อยู่',
                        'value' => function ($model) {
                            return \backend\models\AddressInfo::findAddress($model->id);
                        }
                    ],
                ]]) ?>
        </div>
        <div class="col-lg-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'street',
                        'label' => 'ถนน',
                        'value' => function ($model) {
                            return \backend\models\AddressInfo::findStreet($model->id);
                        }
                    ],
                ]]) ?>
        </div>
        <div class="col-lg-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'district',
                        'label' => 'ตำบล/แขวง',
                        'value' => function ($model) {
                            return \backend\models\AddressInfo::findDistrict($model->id);
                        }
                    ],
                ]]) ?>
        </div>
        <div class="col-lg-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'amphur',
                        'label' => 'อำเภอ/เขต',
                        'value' => function ($model) {
                            return \backend\models\AddressInfo::findAmphur($model->id);
                        }
                    ],
                ]]) ?>
        </div>
        <div class="col-lg-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'province',
                        'label' => 'จังหวัด',
                        'value' => function ($model) {
                            return \backend\models\AddressInfo::findProvince($model->id);
                        }
                    ],
                ]]) ?>
        </div>
        <div class="col-lg-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [

                    [
                        'attribute' => 'zipcode',
                        'label' => 'รหัสไปรษณีย์',
                        'value' => function ($model) {
                            return \backend\models\AddressInfo::findZipcode($model->id);
                        }
                    ],


//            'crated_at',
//            'created_by',
//            'updated_at',
//            'udpated_by',
                ],
            ]) ?>
        </div>
        <div class="col-lg-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
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
                ]]) ?>
        </div>
    </div>
    <br>

    <?php if (count($model_contact_data)): ?>
        <h4>รายชื่อผู้ติดต่อ</h4>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>ชื่อผู้ติดต่อ</th>
                        <th>ช่องทาง</th>
                        <th>ข้อมูล</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($model_contact_data as $value): ?>
                        <?php $i++; ?>
                        <tr>
                            <td style="text-align: center"><?= $i; ?></td>
                            <td><?= $value->contact_name ?></td>
                            <td><?= \backend\helpers\ContactcatType::getTypeById($value->type_id) ?></td>
                            <td><?= $value->contact_no ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
