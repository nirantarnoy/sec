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
                <td style="border: 1px solid lightgrey"><a href="index.php?r=site/profile&id=<?= $party_id; ?>"
                                                           style="text-decoration: none;color: grey;">ข้อมูลส่วนตัว</a>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid lightgrey"><a href="index.php?r=site/addressinfo&id=<?= $party_id; ?>"
                                                           style="text-decoration: none;color: grey;">ที่อยู่สำหรับจัดส่งสินค้า</a>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid lightgrey"><a href="index.php?r=site/myorder&id=<?= $party_id; ?>"
                                                           style="text-decoration: none;color: grey;">การสั่งซื้อของฉัน</a>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid lightgrey"><a href="#"
                                                           style="text-decoration: none;color: red;">ออกจากระบบ</a></td>
            </tr>
        </table>
    </div>
    <div class="col-lg-9">
        <div><b>คำสั่งซื้อ</b></div>
        <br/>
       <div class="row">
           <div class="col-lg-12">
               <table class="table">
                   <thead>
                   <tr>
                       <th>#</th>
                       <th style="width: ">เลขที่คำสั่งซื้อ</th>
                       <th>วันที่</th>
                       <th>เลขที่ติดตามสินค้า</th>
                       <th>สถานะ</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php if(1>0):?>
                   <tr>
                       <td colspan="5" style="padding: 15px;text-align: center;color: lightgrey;">ไม่พบรายการสั่งซื้อ</td>
                   </tr>
                   <?php else:?>
                   <?php endif;?>
                   </tbody>
               </table>
           </div>
       </div>
    </div>
</div>

