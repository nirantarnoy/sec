<?php
$this->title = 'บัญชีของฉัน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-3">
        <div><b>บัญชีของฉัน</b></div>
        <br/>
        <table class="table">
            <tr>
                <td style="border: 1px solid lightgrey"><a href="index.php?r=site/profile" style="text-decoration: none;color: grey;">ข้อมูลส่วนตัว</a></td>
            </tr>
            <tr>
                <td style="border: 1px solid lightgrey"><a href="index.php?r=site/addressinfo" style="text-decoration: none;color: grey;">ที่อยู่สำหรับจัดส่งสินค้า</a></td>
            </tr>
            <tr>
                <td style="border: 1px solid lightgrey"><a href="index.php?r=site/myorder" style="text-decoration: none;color: grey;">การสั่งซื้อของฉัน</a></td>
            </tr>
            <tr>
                <td style="border: 1px solid lightgrey"><a href="#" style="text-decoration: none;color: red;">ออกจากระบบ</a></td>
            </tr>
        </table>
    </div>
    <div class="col-lg-9">
        <div><b>ข้อมูลส่วนตัว</b></div>
        <br/>
        <div style="border: 1px solid #95a5a6;padding: 15px;">
            <div class="row">
                <div class="col-lg-4">
                    <label for="">ชื่อ</label>
                    <input type="text" class="form-control" value="">
                </div>
                <div class="col-lg-4">
                    <label for="">นามสกุล</label>
                    <input type="text" class="form-control" value="">
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-4">
                    <label for="">อีเมล์</label>
                    <input type="text" class="form-control" value="">
                </div>
                <div class="col-lg-4">

                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-4">
                    <label for="">เบอร์โทร</label>
                    <input type="text" class="form-control" value="">
                </div>
            </div>
            <br/>
            <hr/>
            <br />
            <div class="row">
                <div class="col-lg-4">
                    <button class="btn btn-outline-success">บันทึกการแก้ไข</button>
                </div>
                <div class="col-lg-4">

                </div>
            </div>
            <br/>
        </div>
    </div>
</div>