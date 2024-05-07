<?php
$this->title = 'รายละเอียดสินค้า';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-12"><b></b></div>
</div>
<div class="row">
    <div class="col-lg-4">
        <img class="img-fluid" src="<?=\Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/'.'xx.jpg' ?>">
    </div>
    <div class="col-lg-8">
        <div style="borderx: 1px solid lightgrey;padding: 20px;">
            <div><b>รหัสสินค้า</b></div>
            <h5><?=$model->sku?></h5>
            <div><b>ราคา</b></div>
            <div style="color: red;">&#3647 <b><?=$model->sale_price?></b></div>
            <hr />
            <div><b>รายละเอียดสินค้า</b></div>
            <div class="product-detail">
               <span><?=$model->name?></span>
            </div>
            <div><b>หมวดสินค้า</b></div>
            <div><b>จำนวน</b></div>
            <hr />
            <div class="row">
                <div class="col-lg-6" style="text-align: right;">
                    <div class="btn btn-outline-danger">
                        เพิ่มสินค้าใส่ตะกร้า
                    </div>
                </div>
                <div class="col-lg-6" style="text-align: left;">
                    <div class="btn btn-outline-success">
                        ซื้อสินค้า
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>