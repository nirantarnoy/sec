<?php
$emp_name = \backend\models\Employee::findFullName($model->id);
?>
<div style="height: 10px;"></div>
<div class="row">
    <div class="col-lg-3">
        <a href="#">
            <img src="../../backend/web/uploads/logo/narono_logo.png" width="100%" alt="">
        </a>
    </div>
</div>
<div style="height: 15px;"></div>
<div class="row">
    <div class="col-lg-6" style="vertical-align: middle;">
        <h3><span><i class="fa fa-user-circle"></i> </span>พนักงานขับรถ <span style="color: red"> <?=$emp_name?></span></h3>
    </div>
    <div class="col-lg-6" style="text-align: right;">
        <div class="btn-group">
            <a href="<?=\yii\helpers\Url::to(['site/logoutdriver'],true)?>" class="btn btn-danger">ออกจากระบบ</a>
        </div>
    </div>
</div><br />
<div class="row">
    <div class="col-lg-12" style="text-align: center;">
        <h3>แก้ไขข้อมูลส่วนตัว</h3>
    </div>
</div><hr>
