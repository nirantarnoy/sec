<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'คำสั่งซื้อของฉัน';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-lg-3">
        <div><b>บัญชีของฉัน</b></div>
        <br/>
        <table class="table">
            <tr>
                <td style="border: 1px solid lightgrey"><a href="index.php?r=site/profile"
                                                           style="text-decoration: none;color: grey;">ข้อมูลส่วนตัว</a>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid lightgrey"><a href="index.php?r=site/addressinfo"
                                                           style="text-decoration: none;color: grey;">ที่อยู่สำหรับจัดส่งสินค้า</a>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid lightgrey"><a href="index.php?r=site/myorder"
                                                           style="text-decoration: none;color: grey;">การสั่งซื้อของฉัน</a>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid lightgrey"><a href="index.php?r=site/logout"
                                                           style="text-decoration: none;color: red;">ออกจากระบบ</a></td>
            </tr>
        </table>
    </div>
    <div class="col-lg-9">
        <div><b>คำสั่งซื้อ</b></div>
        <br/>
       <div class="row">
           <div class="col-lg-12">
               <table class="table table-striped">
                   <thead>
                   <tr>
                       <th style="text-align: center">#</th>
                       <th style="width: 15%">เลขที่คำสั่งซื้อ</th>
                       <th>วันที่</th>
                       <th>เลขที่ติดตามสินค้า</th>
                       <th>สถานะ</th>
                       <th></th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php if($model == null):?>
                   <tr>
                       <td colspan="5" style="padding: 15px;text-align: center;color: lightgrey;">ไม่พบรายการสั่งซื้อ</td>
                   </tr>
                   <?php else:?>
                   <?php $loop_count = 0;?>
                   <?php foreach($model as $value):?>
                       <?php
                       $loop_count += 1;
                           ?>
                           <tr>
                               <td style="text-align: center"><?=$loop_count?></td>
                               <td><?=$value->order_no?></td>
                               <td><?=date('d-m-Y',strtotime($value->order_date))?></td>
                               <td><?php echo ""?></td>
                               <td><?php echo "รอชำระเงิน"?></td>
                               <td style="width: 20%"><a class="btn btn-sm btn-secondary" href="index.php?r=site/myorderdetail&id=<?=$value->id?>">รายละเอียด</a></td>
                           </tr>
                   <?php endforeach;?>
                   <?php endif;?>
                   </tbody>
               </table>
           </div>
       </div>
    </div>
</div>

