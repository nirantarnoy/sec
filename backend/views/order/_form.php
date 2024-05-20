<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
$issue_id = 0;
$delivery_id = 0;
$do_no = '';
//$model_issue_data = \common\models\JournalIssue::find()->where(['issue_for_id'=>$model->id])->one();
//if($model_issue_data){
//    $issue_id = $model_issue_data->id;
//    if($issue_id){
//        $model_do = \common\models\DeliveryOrder::find()->select(['id','order_no'])->where(['issue_ref_id'=>$issue_id])->one();
//        if($model_do){
//            $delivery_id = $model_do->id;
//            $do_no = $model_do->order_no;
//        }
//    }
//}

$model_do = \common\models\DeliveryOrder::find()->select(['id', 'order_no'])->where(['issue_ref_id' => $model->id])->one();
if ($model_do) {
    $delivery_id = $model_do->id;
    $do_no = $model_do->order_no;
}

?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'order_no')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'order_date')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'total_amount')->textInput(['readonly' => 'readonly']) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'order_tracking_no')->textInput() ?>
        </div>
    </div>

    <br/>
    <div class="row">
        <div class="col-lg-12">
            <h5>รายการละเอียดการสั่งซื้อ</h5>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-6">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width:5%;text-align: center;background-color: #36ab63;color: white;">#</th>
                    <th style="text-align: center;max-width: 50px;background-color: #36ab63;color: white;"></th>
                    <th style="text-align: center;background-color: #36ab63;color: white;">สินค้า</th>
                    <th style="text-align: right;background-color: #36ab63;color: white;">จำนวน</th>
                    <th style="text-align: right;background-color: #36ab63;color: white;">ราคา</th>
                    <th style="text-align: right;background-color: #36ab63;color: white;">รวม</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $qty_total = 0;
                $line_total = 0;
                ?>
                <?php if ($model_line == null): ?>
                    <tr>
                        <td colspan="6" style="padding: 15px;text-align: center;color: lightgrey;">ไม่พบรายการสินค้า
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $loop_count = 0; ?>
                    <?php foreach ($model_line as $model_detail_item): ?>
                        <?php
                        $photo = \backend\models\Product::findPhoto($model_detail_item->product_id);
                        $qty_total = $qty_total + $model_detail_item->qty;
                        $line_total = $line_total + $model_detail_item->line_total;
                        ?>
                        <tr>
                            <td style="text-align: center;"><?= ++$loop_count ?></td>
                            <td style="text-align: center;"><img
                                        src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $photo ?>"
                                        style="margin-top: 5px;max-width: 50px" alt=""></td>
                            <td style="text-align: left;"><?= \backend\models\Product::findName($model_detail_item->product_id) ?></td>
                            <td style="text-align: right;"><?= number_format($model_detail_item->qty, 2) ?></td>
                            <td style="text-align: right;"><?= number_format($model_detail_item->price, 2) ?></td>
                            <td style="text-align: right;"><?= number_format($model_detail_item->line_total, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right;"><b>รวม</b></td>
                    <td style="text-align: right;"><b><?= number_format($qty_total, 2) ?></b></td>
                    <td style="text-align: right;"></td>
                    <td style="text-align: right;"><b><?= number_format($line_total, 2) ?></b></td>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-lg-6">
            <table class="table table-striped table-bordered">
                <!--               <tr>-->
                <!--                   <td style="width: 25%">สถานะชำระเงิน</td>-->
                <!--                   <td>-->
                <!--                       --><?php //if($model->pay_status == 1):?>
                <!--                           <div class="badge badge-success">ชำระแล้ว</div>-->
                <!--                       --><?php //else:?>
                <!--                           <div class="badge badge-secondary">ยังไม่ชำระ</div>-->
                <!--                       --><?php //endif;?>
                <!--                   </td>-->
                <!--               </tr>-->
                <!--               <tr>-->
                <!--                   <td style="width: 25%">หลักฐานการชำระเงิน</td>-->
                <!--                   <td>-->
                <!--                   </td>-->
                <!--               </tr>-->
                <!--               <tr>-->
                <!--                   <td style="width: 25%">วิธีชำระเงิน</td>-->
                <!--                   <td>โอนบัญชีธนาคาร</td>-->
                <!--               </tr>-->
                <!--               <tr>-->
                <!--                   <td>เข้าบัญชีธนาคาร</td>-->
                <!--                   <td>-->
                <!---->
                <!--                   </td>-->
                <!--               </tr>-->
                <tr>
                    <td>ชื่อลูกค้า</td>
                    <td>
                        <?= \backend\models\Customer::findCusFullName(1) ?>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <?= \backend\models\Customer::findEmail(1) ?>
                    </td>
                </tr>
                <tr>
                    <td>เบอร์โทร</td>
                    <td>
                        <?= \backend\models\Customer::findPhone(1) ?>
                    </td>
                </tr>
                <tr>
                    <td>ที่อยู่ในการจัดส่ง</td>
                    <td>
                        <p><?= \backend\models\Customer::findFullAddress(1) ?></p>
                    </td>
                </tr>
                <tr>
                    <td>สถานะคำสั่งซื้อ</td>
                    <?php
                    $color_status = '';
                    if ($model->status == 3) {
                        $color_status = 'color: orange';
                    } elseif ($model->status == 4) {
                        $color_status = 'color: green';
                    } elseif ($model->status == 5) {
                        $color_status = 'color: red';
                    }
                    ?>
                    <td style="<?= $color_status ?>"><?= \backend\helpers\OrderStatus::getTypeById($model->status) ?></td>
                </tr>
                <!--               <tr>-->
                <!--                   <td>เลขที่ติดตามพัสดุ</td>-->
                <!--                   <td style="color: green;">-->
                <!--                       --><?php //=$model->order_tracking_no?>
                <!--                   </td>-->
                <!--               </tr>-->
                <!--               <tr>-->
                <!--                   <td>เลขที่ใบเบิก</td>-->
                <!--                   <td>-->
                <!--                       <a style="text-decoration: none;color: blue;" href="index.php?r=journalissue/update&id=-->
                <?php //=$model_issue_data!=null?$model_issue_data->id:''?><!--">-->
                <?php //=$model_issue_data!=null?$model_issue_data->journal_no:''?><!--</a>-->
                <!--                   </td>-->
                <!--               </tr>-->
                <tr>
                    <td>เลขที่ใบส่งของ</td>
                    <td style="color: green;">
                        <a style="text-decoration: none;color: blue;"
                           href="index.php?r=deliveryorder/update&id=<?= $delivery_id != 0 ? $delivery_id : '' ?>"><?= $delivery_id != null ? $do_no : '' ?></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-6" style="text-align: right;">
            <div class="input-group">
                <?php if ($model_do == null): ?>
                    <a href="index.php?r=order/createdo&order_id=<?= $model->id ?>" class="btn btn-info">สร้างใบส่งสินค้า</a>

                <?php endif; ?>
                <?php if ($delivery_id > 0): ?>

                    <a href="index.php?r=deliveryorder/print&id=<?= $model->id ?>"
                       class="btn btn-warning">พิมพ์ใบเบิก</a>

                <?php endif; ?>
                <?php if ($delivery_id > 0): ?>

                    <a href="index.php?r=deliveryorder/printdo&id=<?= $delivery_id ?>" class="btn btn-warning">พิมพ์ใบส่งของ</a>

                <?php endif; ?>
                <?php if ($delivery_id > 0): ?>

                    <a href="index.php?r=deliveryorder/printreciept&id=<?= $model->id ?>" class="btn btn-secondary">พิมพ์ใบเสร็จ</a>

                <?php endif; ?>
                <?php if ($delivery_id > 0): ?>

                    <a href="index.php?r=deliveryorder/printtaxinvoice&id=<?= $model->id ?>" class="btn btn-info">พิมพ์ใบกำกับ</a>

                <?php endif; ?>
            </div>

        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
