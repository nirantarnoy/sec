<?php

use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;

$this->title = 'ภาพรวมระบบ';
$m_data_gharp = [];
$m_data = [['id' => 1, 'name' => 'มกราคม'], ['id' => 2, 'name' => 'กุมภาพันธ์'], ['id' => 3, 'name' => 'มีนาคม'], ['id' => 4, 'name' => 'เมษายน'], ['id' => 5, 'name' => 'พฤษภาคม'], ['id' => 6, 'name' => 'มิถุนายน'], ['id' => 7, 'name' => 'กรกฎาคม'], ['id' => 8, 'name' => 'สิงหาคม'], ['id' => 9, 'name' => 'กันยายน'], ['id' => 10, 'name' => 'ตุลาคม'], ['id' => 11, 'name' => 'พฤศจิกายน'], ['id' => 12, 'name' => 'ธันวาคม']];
$m_category = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
$m_category_show = [];

$product_count = \backend\models\Product::find()->where(['status' => 1])->count();
$order_count = 0; // \backend\models\Order::find()->count();
$customer_count = \backend\models\Customer::find()->where(['status' => 1])->count();

$model_stock = \backend\models\Stocksum::find()->where(['>', 'qty', 0])->limit(10)->all();

$model_sale_top_product = null; // \common\models\ViewOrderAmount::find()->select(['product_id', 'sku', 'name', 'sum(qty) as qty'])->groupBy(['product_id'])->orderBy(['sum(qty)' => SORT_DESC])->limit(5)->all();
$model_sale_compare = null; // \common\models\ViewOrderAmount::find()->select(['year', 'month', 'sum(cost_amt) as cost_amt', 'sum(sale_amt) as sale_amt'])->groupBy(['year', 'month'])->orderBy(['month' => SORT_ASC])->all();
//$model_sale_compare = \common\models\ViewOrderAmount::find()->orderBy(['month(order_date)'=>SORT_ASC])->all();
//print_r($model_sale_compare);

$m_loop_data = [];
$total = [];
$total_for_gharp = [];

$data_series = $total_for_gharp;

$cost_stock_amt = 0;

?>
<br/>
<br/>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <?php if (\Yii::$app->user->identity->username == 'secadmin'): ?>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3><?= number_format($cost_stock_amt, 2) ?></h3>
                            <p>มูลค่าคงคลัง</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="
                    <?= Url::to(['product/index'], true) ?>" class="small-box-footer">รายละเอียด</a>
                    </div>
                </div>
            <?php endif; ?>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
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
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= number_format($order_count) ?></h3>
                        <!--                        <sup style="font-size: 20px">%</sup>-->
                        <p>จำนวน Job</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?= Url::to(['order/index'], true) ?>" class="small-box-footer">ไปยัง Job <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
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
        <br/>
        <?php
        $date_data = ['มค.', 'กพ.', 'มี.ค.', 'เม.ย.', 'พค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
        $data_series = [
            ['name' => 'ยอดขาย', 'data' => [5000, 15400, 20000, 35000, 50000, 65000, 70000, 75000, 80000, 85000, 90000]],
            ];
        ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        echo Highcharts::widget([
                            'options' => [
                                'title' => ['text' => 'กราฟแสดงยอดขาย'],
                                'xAxis' => [
                                    'categories' => $date_data
                                ],
                                'yAxis' => [
                                    'title' => ['text' => 'จำนวนเงิน']
                                ],
                                'series' => $data_series
                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>
                <div class="col-lg-6">

                    <?php
                    echo Highcharts::widget([
                        'options' => [
                            'chart' => ['type' => 'column'], // Set chart type to column
                            'title' => ['text' => 'เปรียบเทียบต้นทุนกับยอดขาย'],
                            'xAxis' => [
                                'categories' => ['มค.','กพ.','มี.ค.','เม.ย.','พค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'], // Months or periods
                                'crosshair' => true
                            ],
                            'yAxis' => [
                                'title' => ['text' => 'Amount ($)']
                            ],
                            'tooltip' => [
                                'shared' => true,
                                'valueSuffix' => ' $'
                            ],
                            'plotOptions' => [
                                'column' => [
                                    'borderWidth' => 0
                                ]
                            ],
                            'series' => [
                                ['name' => 'ต้นทุน', 'data' => [1200, 1500, 1800, 2000, 2200, 2500, 2700, 2900, 3100, 3300, 3500,5000], 'color' => '#FF5733'], // Cost data
                                ['name' => 'กำไร', 'data' => [800, 1100, 1300, 1700, 1900, 2100, 2300, 2500, 2700, 2900, 3100,8700], 'color' => '#2ECC71'] // Profit data
                            ]
                        ]
                    ]);
                    ?>

                </div>
            </div>
        </div>
</div>