<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Car $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'รถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$doc_type_data = \backend\helpers\CardocType::asArrayObject();
?>
<div class="car-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

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

    <div class="row">
        <div class="col-lg-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'id',
                    'name',
                    'description',
                    'plate_no',
//            'brand_id',
                    [
                        'attribute' => 'driver_id',
                        'value' => function ($data) {
                            return \backend\models\Employee::findFullName($data->driver_id);
                        }
                    ],
                    [
                        'attribute' => 'brand_id',
                        'value' => function ($model){
                            return \backend\models\CarBrand::findCarbrandName($model->brand_id);
                        }
                    ],
                    // 'car_type_id',
                    [
                        'attribute' => 'car_type_id',
                        'value' => function ($model){
                            return \backend\models\CarType::findName($model->car_type_id);
                        }
                    ],

                ],
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'type_id',
                        'value' => function ($model){
                            return \backend\helpers\CarcatType::getTypeById($model->type_id);
                        }
                    ],
                    [
                        'attribute' => 'fuel_type',
                        'value' => function ($model){
                            return \backend\models\FuelType::findFuelTypeName($model->fuel_type);
                        }
                    ],
                    'horse_power',
                    // 'company_id',
                    [
                        'attribute' => 'company_id',
                        'value' => function ($model){
                            return \backend\models\Company::findCompanyName($model->company_id);
                        }
                    ],
                    // 'status',
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

                    // 'created_at',
                    // 'created_by',
                    // 'updated_at',
                    // 'updated_by',
                ],
            ]) ?>
        </div>
    </div>



    <br />
    <div class="row">
        <div class="col-lg-12">
            <h5>เอกสารแนบ</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 20%">ประเภท</th>
                    <th>-</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i <= count($doc_type_data) - 1; $i++): ?>
                    <?php
                    $doc_link = '';
                    $doc_name = checkdocfile($model_doc, $doc_type_data[$i]['id']);
                    ?>

                    <tr>
                        <td><?= $doc_type_data[$i]['name'] ?></td>
                        <td>
                            <a href="<?=\Yii::$app->getUrlManager()->baseUrl.'/uploads/car_doc/'.$doc_name?>" target="_blank"><?=$doc_name?></a>
                        </td>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <h5>ประวัติการชำระค่างวด</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10%;text-align: center;">งวดที่</th>
                    <th style="width: 15%;text-align: center;">วันที่ชำระ</th>
                    <th style="width: 15%;text-align: right;">ยอดที่ชำระ</th>
                    <th>หลักฐาน</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($model_loan as $value):?>
                  <tr>
                      <td style="text-align: center;"><?=$value->period_no;?></td>
                      <td style="text-align: center;"><?=$value->trans_date;?></td>
                      <td style="text-align: right;"><?=number_format($value->loan_pay_amt,2);?></td>
                      <td><a href="<?=\Yii::$app->getUrlManager()->baseUrl.'/uploads/files/carloan/'.$value->doc?>" target="_blank"><?=$value->doc;?></a></td>
                  </tr>
                <?php endforeach;?>

                </tbody>
            </table>
        </div>
    </div>

</div>
<?php
function checkdocfile($model_doc ,$line_id){
    $name = '';
    if($model_doc != null){
        foreach($model_doc as $value){
            if($value->doc_type_id == $line_id){
                $name = $value->docname;
            }
        }
    }
    return $name;
}
?>