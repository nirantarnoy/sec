<?php
$this->title = 'รายละเอียดสินค้า';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-12"><b></b></div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <img class="img-fluid" src="<?=\Yii::$app->urlManagerBackend->getBaseUrl() . '/uploads/product_photo/' . $model->photo ?>">
            </div>
        </div>
        <div style="height: 10px;"></div>
        <div class="row">
            <div class="col-lg-12">
                <img class="img-fluid" src="<?=\Yii::$app->urlManagerBackend->getBaseUrl() . '/uploads/product_photo/' . $model->photo_2 ?>">
            </div>
        </div>

    </div>
    <div class="col-lg-8">
        <div style="borderx: 1px solid lightgrey;padding: 20px;">
            <div><b>รหัสสินค้า</b></div>
            <h5><?=$model->sku?></h5>
            <div><b>ราคา</b></div>
            <div style="color: red;">&#3647 <b><?=$model->customer_id!=null?$model->customer_sale_price:$model->sale_price?></b></div>
            <hr />
            <div><b>รายละเอียดสินค้า</b></div>
            <div class="product-detail">
               <span><?=$model->name?></span>
            </div>
            <br />
            <div><b>หมวดสินค้า</b></div>
            <div><i>ไม่ระบุ</i></div>
            <br />
            <div><b style="color: red;">จำนวนสินค้าคงเหลือ</b></div>
            <br />
            <div><b><?=number_format($model->qty)?></b></div>
            <br />
            <div><b>จำนวน</b></div>
            <div style="max-width: 180px;padding: 15px 15px 15px 0px;">
                <div class="input-group">
                    <div class="btn btn-success" style="font-size: 20px;" onclick="decreaseitem()">-</div>
                    <input type="text" class="form-control cart-selected-qty" style="text-align: center;" name="cart_selected_qty" value="1" pattern="[0-9]" onkeypress="return /[0-9]/i.test(event.key)" >
                    <div class="btn btn-success" style="font-size: 20px;" onclick="increaseitem()">+</div>
                </div>

            </div>
            <hr />
            <div class="row">
                <div class="col-lg-6" style="text-align: right;">
                    <div class="btn btn-outline-danger btn-add-to-cart" data-var="<?=$model->id?>">
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
    <input type="hidden" class="product-id" value="<?=$model->id?>">
    <input type="hidden" class="product-name" value="<?=$model->name?>">
    <input type="hidden" class="price" value="<?=$model->customer_id !=null?$model->customer_sale_price:$model->sale_price?>">
    <input type="hidden" class="qty" value="1">
    <input type="hidden" class="sku" value="<?=$model->sku?>">
    <input type="hidden" class="photo" value="<?=$model->photo?>">

<?php
$url_to_add_cart = \yii\helpers\Url::to(['site/addcart'],true);
$js=<<<JS
$(function(){
    $('.btn-add-to-cart').click(function(){
        var id = $(".product-id").val();
        var name = $(".product-name").val();
        var price = $(".price").val();     
        var qty = $(".cart-selected-qty").val();
        var sku = $(".sku").val();
        var photo = $(".photo").val();
        if(id){
            $.ajax({
            url:'$url_to_add_cart',
            type:'post',
            dataType:'html',
            data:{
                'product_id':id,
                'product_name':name,
                'price':price,
                'qty':qty,
                'sku':sku,
                'photo':photo
            },
            success:function(data){
                 alert(data);
            }
        })
        }
        
    });
    // var fullWidth = 864; // Width in pixels of full-sized image
    //             var fullHeight = 648; // Height in pixels of full-sized image
    //             var thumbnailWidth = 389;  // Width in pixels of thumbnail image
    //             var thumbnailHeight = 292;  // Height in pixels of thumbnail image
    //
    //             // Set size of div
    //             $('#picture').css({
    //                     'width': thumbnailWidth+'px',
    //                     'height': thumbnailHeight+'px'
    //             });
    //
    //             // Hide the full-sized picture
    //             $('#full').hide();
    //
    //             // Toggle pictures on click
    //             $('#picture').click(function() {
    //                     $('#thumbnail').toggle();
    //                     $('#full').toggle();
    //             });
    //
    //             // Do some calculations
    //             $('#picture').mousemove(function(e) {
    //                     var mouseX = e.pageX - $(this).attr('offsetLeft'); 
    //                     var mouseY = e.pageY - $(this).attr('offsetTop'); 
    //
    //                     var posX = (Math.round((mouseX/thumbnailWidth)*100)/100) * (fullWidth-thumbnailWidth);
    //                     var posY = (Math.round((mouseY/thumbnailHeight)*100)/100) * (fullHeight-thumbnailHeight);
    //
    //                     $('#full').css({
    //                             'left': '-' + posX + 'px',
    //                             'top': '-' + posY + 'px'
    //                     });
    //             });
});
function increaseitem(){
    var qty = $(".cart-selected-qty").val();
    qty = parseInt(qty) + 1;
    $(".cart-selected-qty").val(qty);
}
function decreaseitem(){
    var qty = $(".cart-selected-qty").val();
    if(qty <= 1){
        return false;
    }
    qty = parseInt(qty) - 1;
    $(".cart-selected-qty").val(qty);
}
JS;
$this->registerJs($js,static::POS_END);
?>