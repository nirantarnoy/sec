<?php

use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;

$this->title = 'ภาพรวมระบบ';

$m_data = [['id' => 1, 'name' => 'มกราคม'], ['id' => 2, 'name' => 'กุมภาพันธ์'], ['id' => 3, 'name' => 'มีนาคม'], ['id' => 4, 'name' => 'เมษายน'], ['id' => 5, 'name' => 'พฤษภาคม'], ['id' => 6, 'name' => 'มิถุนายน'], ['id' => 7, 'name' => 'กรกฎาคม'], ['id' => 8, 'name' => 'สิงหาคม'], ['id' => 9, 'name' => 'กันยายน'], ['id' => 10, 'name' => 'ตุลาคม'], ['id' => 11, 'name' => 'พฤศจิกายน'], ['id' => 12, 'name' => 'ธันวาคม']];

$product_count = \backend\models\Product::find()->where(['status' => 1])->count();
$order_count = \backend\models\Order::find()->count();
$customer_count = \backend\models\Customer::find()->where(['status' => 1])->count();

$model_stock = \backend\models\Stocksum::find()->where(['>','qty',0])->andFilterWhere(['!=','year(expired_date)',1970])->groupBy(['product_id'])->orderBy(['expired_date' => SORT_ASC])->limit(10)->all();

$model_sale_top_product = \common\models\ViewOrderAmount::find()->select(['product_id','sku','name','sum(qty) as qty'])->groupBy(['product_id'])->orderBy(['sum(qty)' => SORT_DESC])->limit(5)->all();
$model_sale_compare = \common\models\ViewOrderAmount::find()->select(['year','month','sum(cost_amt) as cost_amt','sum(sale_amt) as sale_amt'])->groupBy(['year','month'])->orderBy(['month'=>SORT_ASC])->all();
//$model_sale_compare = \common\models\ViewOrderAmount::find()->orderBy(['month(order_date)'=>SORT_ASC])->all();
//print_r($model_sale_compare);
?>
<br/>
<br/>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= number_format($product_count) ?></h3>
                        <p>จำนวนสินค้าทั้งหมด</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?= Url::to(['product/index'], true) ?>" class="small-box-footer">ไปยังสินค้า <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= number_format($order_count) ?></h3>
                        <!--                        <sup style="font-size: 20px">%</sup>-->
                        <p>จำนวนคำสั่งซื้อ</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?= Url::to(['order/index'], true) ?>" class="small-box-footer">ไปยังคำสั่งซื้อ <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= number_format($customer_count) ?></h3>
                        <p>จำนวนลูกค้า</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?= Url::to(['customer/index'], true) ?>" class="small-box-footer">ไปยังข้อมูลลูกค้า <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
        <br />
        <label for="">สินค้ายอดขายสูงสุด 5 อันดับ</label>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th style="text-align: center">SKU</th>
                        <th style="text-align: center">ชื่อสินค้า</th>
                        <th style="text-align: right">จำนวน</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model_sale_top_product as $key => $value): ?>

                        <tr>
                            <td style="text-align: center"><?= \backend\models\Product::findSku($value->product_id) ?></td>
                            <td style="text-align: left"><?= \backend\models\Product::findName($value->product_id) ?></td>
                            <td style="text-align: right;"><?= number_format($value->qty) ?></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br />
        <label for="">รายการสินค้าใกล้หมดอายุ</label>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th style="text-align: center">SKU</th>
                        <th style="text-align: center">ชื่อสินค้า</th>
                        <th style="text-align: center">วันที่หมดอายุ</th>
                        <th style="text-align: right">จำนวน</th>
                        <th style="text-align: right">จะหมดอายุในอีก</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model_stock as $key => $value): ?>
                        <?php
                        $left_date = 0;
                        $date1 = date_create(date('Y-m-d'));
                        $date2 = date_create(date('Y-m-d', strtotime($value->expired_date)));

                        if($value->expired_date != null){
                            $left_date = date_diff( $date1,$date2);
                        }
                        $show_color = 'green';
                        if(date('Y-m-d',strtotime($value->expired_date)) < date('Y-m-d')){
                            $show_color = 'red';
                        }
                        // return $date1->format('d-m-Y');
                        // return '<span style="color: '.$show_color.'">'.$left_date->format('%a').'</span>';
                        ?>
                        <tr>
                            <td style="text-align: center"><?= \backend\models\Product::findSku($value->product_id) ?></td>
                            <td style="text-align: left"><?= \backend\models\Product::findName($value->product_id) ?></td>
                            <td style="text-align: center;"><?= date('d/m/Y',strtotime($value->expired_date)) ?></td>
                            <td style="text-align: right;"><?= number_format($value->qty) ?></td>
                            <td style="text-align: right;color:<?=$show_color?>"><?= number_format($left_date->format('%a')). ' วัน' ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br />
        <label for="">เปรียบเทียบทุนกำไร</label>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th style="text-align: center">เดือน</th>
                        <th style="text-align: right">ราคาทุน</th>
                        <th style="text-align: right">ราคาขาย</th>
                        <th style="text-align: right">กำไร</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model_sale_compare as $value): ?>
                        <?php
                          $m_name = '';
                          for($x = 1; $x <= $m_data; $x++){
                              if($m_data[$x]['id'] == $value->month){
                                  $m_name = $m_data[$x]['name'];
                                  break;
                              }
                          }
                        ?>
                        <tr>
                            <td style="text-align: center"><?= $m_name ?></td>
                            <td style="text-align: right"><?= number_format($value->cost_amt) ?></td>
                            <td style="text-align: right;"><?= number_format($value->sale_amt) ?></td>
                            <td style="text-align: right;"><?= number_format($value->sale_amt-$value->cost_amt) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br />
    </div>
</div>