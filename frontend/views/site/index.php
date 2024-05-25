<?php

/** @var yii\web\View $this */

use yii\bootstrap4\LinkPager;
use yii\helpers\Url;
use yii\web\JqueryAsset;

$this->title = 'ANNAB';

$cart_item_count = 0;
////if (isset($_POST['add_to_cart'])) {
if (isset($_SESSION['cart'])) {
//        $session_array_id = array_column($_SESSION['cart'], 'id');
//        if (!in_array($_GET['id'], $session_array_id)) {
//            $session_array = array(
//                "id" => $_GET['id'],
//                "name" => "soap",// $_POST['name'],
//                "price" => 100, //$_POST['price'],
//                "qty" => 2, //$_POST['qty']
//            );
//
//            $_SESSION['cart'][] = $session_array;
//        }
//    } else {
//        $session_array = array(
//            "id" => $_GET['id'],
//            "name" => "soap",// $_POST['name'],
//            "price" => 100, //$_POST['price'],
//            "qty" => 2, //$_POST['qty']
//        );
//
//        $_SESSION['cart'][] = $session_array;
    $cart_item_count = count($_SESSION['cart']);
    //  var_dump($_SESSION['cart']);
}
////}
//
//var_dump($_SESSION['cart']);
//unset($_SESSION['cart']);

?>
<br/>
<div class="container-cart-index">
    <form action="index.php?r=site/index" method="get">
        <div class="row">
            <div class="col-lg-2">
                <?php
                echo \kartik\select2\Select2::widget([
                    'name' => 'product_cat_search',
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Productgroup::find()->where(['status' => 1])->all(), 'id', 'name'),
                    'value' => $product_cat_search,
                    'options' => [
                        'placeholder' => 'ทุกหมวดสินค้า'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]);
                ?>
            </div>
            <div class="col-lg-7">
                <input type="text" class="form-control" name="product_search" value="" placeholder="ค้นหาสินค้า">
            </div>
            <div class="col-lg-1">
                <button class="btn btn-outline-secondary">ค้นหา</button>
            </div>
            <div class="col-lg-2">
                <!--                <div class="btn icon-cart" style="color: red;">สินค้า -->
                <?php //= $cart_item_count ?><!--</div>-->
                <a href="index.php?r=site/yourcart" style="color: red;text-decoration: none">ตะกร้าสินค้า
                    <div class="badge"
                         style="font-size: 20px;background-color: black;color:white;"><?= $cart_item_count ?></div>
                </a>
            </div>
        </div>
    </form>
    <br/>
    <?php if ($product_cat_search != null || $product_search != null): ?>
        <div class="row">
            <div class="col-lg-12">
                ผลการค้นหา <span style="color: red;"><i>"<?= $product_search ?>"</i></span>
            </div>
        </div>
        <br/>
    <?php endif; ?>
    <div class="row">
        <?php foreach ($model as $value): ?>
            <?php
            $include_vat_text  = '';
            $sale_price = $value->sale_price;
            $new_name = substr($value->name, 0, 120);
            if ($value->customer_id != null && $value->customer_id == $customer_id) {
                $sale_price = $value->customer_sale_price;
            }
            if ($value->customer_id != null && $value->customer_id == $customer_id) {
                if ($value->include_vat == 1) {
                    $include_vat_text = '( รวม Vat )';
                } else {
                    $include_vat_text = '( ไม่รวม Vat )';
                }
            }
            ?>
            <div class="col-lg-2">
                <div class="card-product">
                    <div class="card" style="margin-top: 20px;">
                        <a style="text-decoration: none;color: black;" href="index.php?r=site/productdetail&id=<?= $value->id ?>"
                           target="_parent">
                            <img class="card-img-top"
                                 src="<?= \Yii::$app->urlManagerBackend->getBaseUrl() . '/uploads/product_photo/' . $value->photo ?>"
                                 alt="Card image" style="max-width: 200px;">
                            <div class="card-body">
                                <h4 class="card-title" style="font-size: 16px;">SKU: <b><?= $value->sku ?></b></h4>
                                <p class="" style="font-size: 14px;"><?= $new_name ?></p>
                                <h4 class="card-title" style="font-size: 16px;"><b
                                            style="color: red;">&#3647 <?= $sale_price ?> <span style="font-size: 10px;"><?= $include_vat_text ?></span></b></h4>
                                <h4 class="card-title" style="font-size: 16px;"><span
                                            style="color: red;font-size: 12px;">สต๊อก <?= number_format($value->qty) ?></span></h4>
                            </div>
                        </a>
                        <div class="card-footer" style="text-align: center;">
                            <div class="btn btn-outline-success btn-add-to-cart" onclick="addtocart($(this))" data-var="<?= $value->id ?>">
                                เพิ่มใส่ตะกร้า
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        <?php endforeach; ?>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <?php echo LinkPager::widget([
                'pagination' => $pages,
                'nextPageLabel' => '<span aria-hidden=\"true\">&raquo;</span></span>',
                'prevPageLabel' => '<span aria-hidden=\"true\">&laquo;</span>',
            ]);
            ?>
        </div>
    </div>

    <!--    <div class="row">-->
    <!--        <div class="col-lg-12">-->
    <!--            <table class="table">-->
    <!--                <tr>-->
    <!--                    <td>Name</td>-->
    <!--                    <td>Price</td>-->
    <!--                    <td>Qty</td>-->
    <!--                </tr>-->
    <!--            --><?php //if(!empty($_SESSION['cart'])):?>
    <!--                --><?php //foreach($_SESSION['cart'] as $key => $valuex):?>
    <!--                    <tr>-->
    <!--                        <td>--><?php //=$valuex['name']?><!--</td>-->
    <!--                        <td>--><?php //=$valuex['price']?><!--</td>-->
    <!--                        <td>--><?php //=$valuex['qty']?><!--</td>-->
    <!--                    </tr>-->
    <!--                --><?php //endforeach;?>
    <!--            --><?php //endif;?>
    <!--            </table>-->
    <!--        </div>-->
    <!--    </div>-->
</div>

<!--<div class="cartTab_">-->
<!--    <div style="height: 155px; "></div>-->
<!--    <h5 style="color: grey">สินค้าในตะกร้า</h5>-->
<!---->
<!--       -->
<!--    <div class="btn">-->
<!--        <button class="btn btn-outline-danger close">ปิด</button>-->
<!--        <button class="btn btn-outline-primary checkOut">ชำระเงิน</button>-->
<!--    </div>-->
<!--</div>-->

<?php
$uri = Url::base();
//$this->registerCssFile("{$uri}/js/bootstrap.css", ['depends' => JqueryAsset::class]);
$this->registerJsFile("{$uri}/js/cart.js", ['depends' => JqueryAsset::class]);
$url_to_add_cart2 = \yii\helpers\Url::to(['site/addcart2'], true);
$js = <<<JS
$(function(){
    $(".alert-over-qty").hide();
});

function addtocart(e){
        var id = e.attr("data-var");
        if(id){
            $.ajax({
            url:'$url_to_add_cart2',
            type:'post',
            dataType:'html',
            data:{
                'product_id':id
            },
            success:function(data){
                 alert(data);
            }
        });
        }
}

JS;
$this->registerJs($js, static::POS_END);
?>
