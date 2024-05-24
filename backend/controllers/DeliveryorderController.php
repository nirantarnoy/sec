<?php

namespace backend\controllers;

use backend\models\Deliveryorder;
use backend\models\DeliveryorderSearch;
use backend\models\PositionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DeliveryorderController implements the CRUD actions for Deliveryorder model.
 */
class DeliveryorderController extends Controller
{
    public $enableCsrfValidation = false;
    /*
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST','GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Deliveryorder models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $viewstatus = 1;

        if (\Yii::$app->request->get('viewstatus') != null) {
            $viewstatus = \Yii::$app->request->get('viewstatus');
        }

        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new DeliveryorderSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
//        if($viewstatus ==1){
//            $dataProvider->query->andFilterWhere(['status'=>$viewstatus]);
//        }
//        if($viewstatus == 2){
//            $dataProvider->query->andFilterWhere(['status'=>0]);
//        }

        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
            'viewstatus' => $viewstatus,
        ]);
    }

    /**
     * Displays a single Deliveryorder model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Deliveryorder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Deliveryorder();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Deliveryorder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model_line = \common\models\DeliveryOrderLine::find()->where(['delivery_order_id' => $id])->all();

        $model_cal_line = \common\models\DeliveryOrderCal::find()->where(['delivery_order_id' => $id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $line_rec_id = \Yii::$app->request->post('line_rec_id');
            $line_name = \Yii::$app->request->post('line_product_name');
            $line_qty = \Yii::$app->request->post('line_qty');
            $line_description = \Yii::$app->request->post('line_product_name_description');

            $line_stock_sum_id = \Yii::$app->request->post('line_stock_sum_idx');
            $line_rec_idx = \Yii::$app->request->post('line_rec_idx');
            $line_product_idx = \Yii::$app->request->post('line_product_idx');
            $line_issue_qtyx = \Yii::$app->request->post('line_issue_qtyx');
            $line_per_box_qtyx = \Yii::$app->request->post('line_per_box_qtyx');
            $line_box_qtyx = \Yii::$app->request->post('line_box_qtyx');
            $line_diff_qtyx = \Yii::$app->request->post('line_diff_qtyx');


            if ($model->save(false)) {
                if ($line_rec_id != null) {
                    for ($i = 0; $i < count($line_rec_id); $i++) {
                        \common\models\DeliveryOrderLine::updateAll(['name' => $line_name[$i], 'description' => $line_description[$i], 'qty' => $line_qty[$i]], ['id' => $line_rec_id[$i]]);
                    }
                }

                if ($line_stock_sum_id != null) {
                    for ($x = 0; $x < count($line_stock_sum_id); $x++) {
                        $model_cal_check = \common\models\DeliveryOrderCal::find()->where(['id' => $line_rec_idx[$x]])->one();
                        if ($model_cal_check) {
                            $model_cal_check->delivery_order_id = $model->id;
                            $model_cal_check->delivery_line_id = $line_rec_idx[$x];
                            $model_cal_check->product_id = $line_product_idx[$x];
                            $model_cal_check->qty_per_pack = $line_per_box_qtyx[$x];
                            $model_cal_check->total_pack = $line_box_qtyx[$x];
                            $model_cal_check->left_qty = $line_diff_qtyx[$x];
                            $model_cal_check->issue_qty = $line_issue_qtyx[$x];
                            $model_cal_check->stock_sum_id = $line_stock_sum_id[$x];
                            $model_cal_check->save(false);
                        } else {
                            $model_cal = new \common\models\DeliveryOrderCal();
                            $model_cal->delivery_order_id = $model->id;
                            $model_cal->delivery_line_id = $line_rec_idx[$x];
                            $model_cal->product_id = $line_product_idx[$x];
                            $model_cal->qty_per_pack = $line_per_box_qtyx[$x];
                            $model_cal->total_pack = $line_box_qtyx[$x];
                            $model_cal->left_qty = $line_diff_qtyx[$x];
                            $model_cal->issue_qty = $line_issue_qtyx[$x];
                            $model_cal->stock_sum_id = $line_stock_sum_id[$x];
                            if ($model_cal->save(false)) {
                                $warehouse_id = \backend\models\Stocksum::find()->where(['id' => $line_stock_sum_id[$x]])->one()->warehouse_id;
                                $model_trans = new \backend\models\Stocktrans();
                                $model_trans->trans_date = date('Y-m-d H:i:s');
                                $model_trans->activity_type_id = 2; // issue reduce stock
                                $model_trans->product_id = $line_product_idx[$x];
                                $model_trans->qty = $line_issue_qtyx[$x];
                                $model_trans->trans_ref_id = $model->id;
                                $model_trans->stock_type_id = 2; // 2 = out
                                $model_trans->warehouse_id = $warehouse_id;
                                if ($model_trans->save(false)) {
                                    $model_update_stock = \backend\models\Stocksum::find()->where(['id' => $line_stock_sum_id[$x]])->one();
                                    if ($model_update_stock) {
                                        if ($model_update_stock->qty >= $line_issue_qtyx[$x]) {
                                            $model_update_stock->qty = $model_update_stock->qty - $line_issue_qtyx[$x];
                                            $model_update_stock->save(false);
                                        }
                                    }
                                }

                            }
                        }

                    }
                }
                $this->notifymessage($model->id,$model->order_no,$model->created_by);
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line,
            'model_cal_line' => $model_cal_line,
        ]);
    }

    /**
     * Deletes an existing Deliveryorder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        \common\models\DeliveryOrderLine::deleteAll(['delivery_order_id' => $id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Deliveryorder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Deliveryorder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Deliveryorder::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPrint($id)
    {
        //if($id != null){
        $model = \backend\models\Order::find()->where(['id' => $id])->one();
        $model_line = \common\models\OrderLine::find()->where(['order_id' => $id])->all();
        return $this->render('_print', [
            'model' => $model,
            'model_line' => $model_line
        ]);
        //}
    }

    public function actionPrintdo($id)
    {
        //if($id != null){
        $model = \backend\models\Deliveryorder::find()->where(['id' => $id])->one();
        $model_line = \common\models\DeliveryOrderLine::find()->where(['delivery_order_id' => $id])->all();
        return $this->render('_printdo', [
            'model' => $model,
            'model_line' => $model_line
        ]);
        //}
    }

    public function actionPrintreciept($id)
    {
        //if($id != null){
        $model = \backend\models\Order::find()->where(['id' => $id])->one();
        $model_line = \common\models\OrderLine::find()->where(['order_id' => $id])->all();
        return $this->render('_printreciept', [
            'model' => $model,
            'model_line' => $model_line
        ]);
        //}
    }

    public function actionPrinttaxinvoice($id)
    {
        //if($id != null){
        $model = \backend\models\Order::find()->where(['id' => $id])->one();
        $model_line = \common\models\OrderLine::find()->where(['order_id' => $id])->all();
        return $this->render('_printtaxinvoice', [
            'model' => $model,
            'model_line' => $model_line
        ]);
        //}
    }

    public function actionFindstock()
    {
        $do_id = \Yii::$app->request->post('do_id');
        // $customer_id =  \Yii::$app->request->post('customer_id');
        $html = '';
        if ($do_id > 0) {
            $model_do = \common\models\DeliveryOrderLine::find()->select(['id', 'product_id', 'qty'])->where(['delivery_order_id' => $do_id])->all();
            if ($model_do) {
                foreach ($model_do as $value) {
                    $model = \backend\models\Stocksum::find()->select(['id', 'product_id', 'expired_date', 'qty'])->where(['product_id' => $value->product_id])->orderBy(['expired_date' => SORT_ASC])->all();
                    if ($model) {
                        foreach ($model as $x_value) {
                            if ($x_value->qty <= 0) continue;
                            $line_sku = \backend\models\Product::findSku($x_value->product_id);
                            $line_name = \backend\models\Product::findName($x_value->product_id);
                            $html .= '<tr>';
                            $html .= '<td style="text-align: center">
                            <div class="btn btn-outline-success btn-sm" onclick="addselecteditem($(this))" data-var="' . $x_value->id . '">เลือก</div>                        
                            <input type="hidden" class="line-find-do-id" value="' . $do_id . '">
                            <input type="hidden" class="line-find-do-line-id" value="' . $value->id . '">
                            <input type="hidden" class="line-find-product-id" value="' . $x_value->product_id . '">                          
                            <input type="hidden" class="line-find-product-qty" value="' . $x_value->qty . '">
                            <input type="hidden" class="line-find-product-issue-qty" value="' . $value->qty . '">
                            <input type="hidden" class="line-find-product-sku" value="' . $line_sku . '">
                            <input type="hidden" class="line-find-product-name" value="' . $line_name . '">
                            <input type="hidden" class="line-find-product-expired-date" value="' . date('d-m-Y', strtotime($x_value->expired_date)) . '">
                           </td>';
                            $html .= '<td style="text-align: center">' . $line_sku . '</td>';
                            $html .= '<td style="text-align: left">' . $line_name . '</td>';
                            $html .= '<td style="text-align: center">' . date('d-m-Y', strtotime($x_value->expired_date)) . '</td>';
                            $html .= '<td style="text-align: right">' . number_format($x_value->qty, 1) . '</td>';
                            $html .= '</tr>';
                        }
                    }
                }
            }

        }
        echo $html;
    }
    public function notifymessage($issue_id,$journal_no,$user_id)
    {
        if($issue_id > 0){
            //$message = "This is test send request from camel paperless";
            $line_api = 'https://notify-api.line.me/api/notify';
            $line_token = '';

            $b_token = '8H8dtjz5QWvWWBFrMAwYrglYhkwu3Pw7rnXeBK9vYFK';
            $line_token = trim($b_token);


            $journal_detail = '';
            $user_name = \backend\models\User::findName($user_id);
            $model_line = \common\models\DeliveryOrderLine::find()->where(['delivery_order_id'=>$issue_id])->all();
            if($model_line){
                foreach($model_line as $value){
                    $product_code = \backend\models\Product::findSku($value->product_id);
                    $product_name = \backend\models\Product::findName($value->product_id);

                    $journal_detail.= $product_code.' '.$product_name.' '.number_format($value->qty)."\n";
                }
            }

            $message = '' . "\n";
            $message .= 'แจ้งเตือนรับเข้าสินค้า' . "\n";
            $message .= 'พนักงาน:' . $user_name . "\n";
            //   $message .= 'User:' . \backend\models\User::findName($user_id) . "\n";
            $message .= "วันที่:" . date('Y-m-d') . "(" . date('H:i:s') . ")" . "\n";

            $message .= 'เลขที่รับเบิก: ' .$journal_no. "\n";
            $message .= "รายละเอียด: \n " . $journal_detail. "\n";

            //  $message .= 'สามารถดูรายละเอียดได้ที่ http:///103.253.73.108/icesystemdindang/backend/web/index.php?r=dailysum/indexnew' . "\n"; // bkt


            $queryData = array('message' => $message);
            $queryData = http_build_query($queryData, '', '&');
            $headerOptions = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                        . "Authorization: Bearer " . $line_token . "\r\n"
                        . "Content-Length: " . strlen($queryData) . "\r\n",
                    'content' => $queryData
                )
            );
            $context = stream_context_create($headerOptions);
            $result = file_get_contents($line_api, FALSE, $context);
            $res = json_decode($result);
            return $res;
        }

    }
}
