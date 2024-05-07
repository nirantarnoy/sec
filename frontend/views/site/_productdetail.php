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
            <h5>25098999</h5>
            <div>$B 250</div>
            <hr />
            <div><b>รายละเอียดสินค้า</b></div>
            <div class="product-detail">

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