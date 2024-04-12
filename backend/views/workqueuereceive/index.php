<?php
$model = $dataProvider->getModels();

$emp_name = \backend\models\Employee::findFullName($emp_id);
?>
<div style="height: 15px;"></div>
<div class="row">
    <div class="col-lg-3">
        <a href="#">
            <img src="../../backend/web/uploads/logo/narono_logo.png" width="100%" alt="">
        </a>
    </div>
</div>
<div style="height: 10px;"></div>
<div class="row">
    <div class="col-lg-6" style="vertical-align: middle;">
       <h3><span><i class="fa fa-user-circle"></i> </span>พนักงานขับรถ <span style="color: red"> <?=$emp_name?></span></h3>
    </div>
    <div class="col-lg-6" style="text-align: right;">
        <div class="btn-group">
            <a href="<?=\yii\helpers\Url::to(['workqueuereceive/editprofile','id'=>$emp_id],true)?>" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไขข้อมูลส่วนตัว</a>
            <a href="<?=\yii\helpers\Url::to(['site/logoutdriver'],true)?>" class="btn btn-danger"><i class="fa fa-power-off"></i> ออกจากระบบ</a>
        </div>
    </div>
</div><br />
<div class="row">
    <div class="col-lg-12" style="text-align: center;">
        <h3>รายการคิวงานของคุณ</h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered">
          <thead>
          <tr>
              <th style="width: 10%;text-align: center;">ลำดับที่</th>
              <th>เลขที่คิวงาน</th>
              <th>วันที่</th>
              <th>บริษัท</th>
              <th>ปลายทาง</th>
              <th style="width: 15%;text-align: center;">รายละเอียด</th>
          </tr>
          </thead>
            <tbody>
            <?php $x = 0;?>
             <?php foreach ($model as $value):?>
                 <?php $x +=1;?>
             <tr>
                 <td style="text-align: center;vertical-align: middle;"><?=$x?></td>
                 <td style="vertical-align: middle;"><?=$value->work_queue_no?></td>
                 <td style="vertical-align: middle;"><?=date('d-m-Y H:i:s',strtotime($value->work_queue_date))?></td>
                 <td style="vertical-align: middle;"><?=\backend\models\Customer::findCusName($value->customer_id)?></td>
                 <td style="vertical-align: middle;"><?=\backend\models\RoutePlan::findDes($value->route_plan_id)?></td>
                 <td style="text-align: center;">
                     <a href="<?=\yii\helpers\Url::to(['workqueuereceive/view','id'=>$value->id],true)?>" target="_parent" class="btn btn-success">ดูรายละเอียด</a>
                 </td>
             </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
