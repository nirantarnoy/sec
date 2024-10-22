<?php

namespace backend\controllers;

use backend\models\Journalissue;
use backend\models\JournalissueSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JournalissueController implements the CRUD actions for Journalissue model.
 */
class JournalissueController extends Controller
{
    /**
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
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    'denyCallback' => function ($rule, $action) {
                        throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
                    },
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                $currentRoute = \Yii::$app->controller->getRoute();
                                if (\Yii::$app->user->can($currentRoute)) {
                                    return true;
                                }
                            }
                        ]
                    ]
                ],
            ]
        );
    }

    /**
     * Lists all Journalissue models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new JournalissueSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);


        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
            'viewstatus' => '',
        ]);
    }

    /**
     * Displays a single Journalissue model.
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
     * Creates a new Journalissue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Journalissue();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $line_item_id = \Yii::$app->request->post('line_product_id');
                $line_warehouse_id = \Yii::$app->request->post('line_product_warehouse_id');
                $line_qty = \Yii::$app->request->post('line_qty');
                $line_remark = \Yii::$app->request->post('line_remark');
                $xdate = explode('-', $model->trans_date);
                $t_date = date('Y-m-d');
                if (count($xdate) > 1) {
                    $t_date = $xdate[2] . '-' . $xdate[1] . '-' . $xdate[0];
                }

                $model->journal_no = Journalissue::getLastNo();
                $model->trans_date = date('Y-m-d', strtotime($t_date));
                if ($model->save(false)) {
                    if ($line_item_id != null) {
                        for ($i = 0; $i <= count($line_item_id) - 1; $i++) {
                            $model_line = new \common\models\JouranlIssueLine();
                            $model_line->journal_issue_id = $model->id;
                            $model_line->product_id = $line_item_id[$i];
                            $model_line->qty = $line_qty[$i];
                            $model_line->status = 0;
                            $model_line->warehouse_id = $line_warehouse_id[$i];
                           // $model_line->reason = $line_remark[$i];
                            if ($model_line->save(false)) {
                                $model_trans = new \backend\models\Stocktrans();
                                $model_trans->journal_no = $model->journal_no;
                                $model_trans->trans_date = date('Y-m-d H:i:s');
                                $model_trans->product_id = $line_item_id[$i];
                                $model_trans->qty = (float)$line_qty[$i];
                                $model_trans->activity_type_id = 2; // 2 is issue
                                $model_trans->stock_type_id = 2; // 1 = in , 2 = out
                                $model_trans->warehouse_id = $line_warehouse_id[$i];
                                $model_trans->trans_ref_id = $model->id;
                                if ($model_trans->save(false)) {
                                    $model_stock = \backend\models\Stocksum::find()->where(['product_id' => $line_item_id[$i], 'warehouse_id' => $line_warehouse_id[$i]])->one();
                                    if ($model_stock) {
                                        $model_stock->qty = (float)$model_stock->qty - (float)$line_qty[$i];
                                   //     $model_stock->last_update = date('Y-m-d H:i:s');
                                        $model_stock->save(false);
                                    } else {
//                                        $model_new = new \backend\models\Stocksum();
//                                        $model_new->company_id = 1;
//                                        $model_new->item_id = $line_item_id[$i];
//                                        $model_new->warehouse_id = $line_warehouse_id[$i];
//                                        $model_new->qty = (float)$line_qty[$i];
//                                        $model_new->last_update = date('Y-m-d H:i:s');
//                                        $model_new->save(false);

                                    }
                                }
                            }
                        }
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Journalissue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line = \common\models\JouranlIssueLine::find()->where(['journal_issue_id' => $id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $line_rec_id = \Yii::$app->request->post('line_rec_id');
            $line_item_id = \Yii::$app->request->post('line_product_id');
            $line_warehouse_id = \Yii::$app->request->post('line_warehouse_id');
            $line_product_expiry_date = \Yii::$app->request->post('line_product_expiry_date');
            $line_remark = \Yii::$app->request->post('line_remark');
            $line_qty = \Yii::$app->request->post('line_qty');
            $removelist = \Yii::$app->request->post('removelist');

            //print_r($line_item_id);return;

            $xdate = explode('-', $model->trans_date);
            $t_date = date('Y-m-d');
            if (count($xdate) > 1) {
                $t_date = $xdate[2] . '-' . $xdate[1] . '-' . $xdate[0];
            }
            $model->trans_date = date('Y-m-d', strtotime($t_date));

            if ($model->save(false)) {
                if ($line_rec_id != null) {
                    for ($i = 0; $i <= count($line_rec_id) - 1; $i++) {
                        $model_line = \common\models\JouranlIssueLine::find()->where(['id' => $line_rec_id[$i]])->one();
                        $model_line->warehouse_id = $line_warehouse_id[$i];
                        $model_line->stock_sum_id = $line_product_expiry_date[$i];
                        $model_line->remark = $line_remark[$i];
                        $model_line->qty = $line_qty[$i];
                        if ($model_line->save(false)) {
                            $model_trans = new \backend\models\Stocktrans();
                            $model_trans->journal_no = $model->journal_no;//$model_trans::getIssueLastNo();
                            $model_trans->trans_date = date('Y-m-d H:i:s');
                            $model_trans->product_id = $model_line->product_id;
                            $model_trans->qty = (float)$line_qty[$i];
                            $model_trans->activity_type_id = 2; // 2 is deduct issue
                            $model_trans->stock_type_id = 2; // 1 = in , 2 = out
                            $model_trans->trans_ref_id = $model->id;
                            if ($model_trans->save(false)) {
                                //  $model_stock = \backend\models\Stocksum::find()->where(['product_id' => $model_line->product_id, 'warehouse_id' => $line_warehouse_id[$i]])->one();
                                $model_stock = \backend\models\Stocksum::find()->where(['id' => $line_product_expiry_date[$i]])->one();
                                if ($model_stock) {
                                    if ($model_stock->qty >= $line_qty[$i]) {
                                        $model_stock->qty = (float)$model_stock->qty - (float)$line_qty[$i];
                                        $model_stock->save(false);
                                    }
                                }
                            }
                        }
                    }

                }
//                if ($line_item_id != null) {
//                    for ($i = 0; $i <= count($line_item_id) - 1; $i++) {
//                        $model_check = \common\models\JournalIssueLine::find()->where(['journal_issue_id' => $model->id, 'product_id' => $line_item_id[$i]])->one();
//                        if ($model_check) {
//                            $model_check->product_id = $line_item_id[$i];
//                            $model_check->qry = $line_qty[$i];
//                            $model_check->status = 0;
//                            $model_check->warehouse_id = $line_warehouse_id[$i];
//                            $model_check->save(false);
//                        } else {
//                            $model_line = new \common\models\JournalIssueLine();
//                            $model_line->journal_issue_id = $model->id;
//                            $model_line->product_id = $line_item_id[$i];
//                            $model_line->qry = $line_qty[$i];
//                            $model_line->status = 0;
//                            $model_line->warehouse_id = $line_warehouse_id[$i];
//                            $model_line->save(false);
//                        }
//
//                    }
//                }

                if ($removelist != null) {
                    $x = explode(',', $removelist);
                    if ($x != null) {
                        for ($m = 0; $m <= count($x) - 1; $m++) {
                            $model_return = \common\models\JournalIssueLine::find()->where(['id' => $x[$m]])->one();
                            if ($model_return) {
                                $model_trans = new \backend\models\Stocktrans();
                                $model_trans->journal_no = \backend\models\Journalissue::getReturnLastNo();
                                $model_trans->trans_date = date('Y-m-d H:i:s');
                                $model_trans->item_id = $model_return->product_id;
                                $model_trans->qty = (float)$model_return->qry;
                                $model_trans->activity_type_id = 4; // 4 is return issue
                                $model_trans->stock_type_id = 1; // 1 = in , 2 = out
                                $model_trans->trans_ref_id = $model->id;
                                if ($model_trans->save(false)) {
                                    $model_stock = \backend\models\Stocksum::find()->where(['item_id' => $model_return->product_id, 'warehouse_id' => $line_warehouse_id[$m]])->one();
                                    if ($model_stock) {
                                        $model_stock->qty = (float)$model_stock->qty + (float)$model_return->qry;
                                        $model_stock->save(false);
                                    } else {
//                                        $model_new = new \backend\models\Stocksum();
//                                        $model_new->company_id = 1;
//                                        $model_new->item_id = $model_return->product_id;
//                                        $model_new->warehouse_id = $line_warehouse_id[$m];
//                                        $model_new->qty = (float)$model_return->qry;
//                                        $model_new->last_update = date('Y-m-d H:i:s');
//                                        $model_new->save(false);

                                    }
                                }
                                $model_return->status = 3; // 3 is cancel
                                $model_return->save(false);
                            }
                        }
                    }
                }

                if (\common\models\JournalIssue::updateAll(['status' => 100], ['id' => $model->id])) {
                    $this->createDeliveryorder($id);
                   // $this->notifymessage($model->id, $model->journal_no, $model->created_by);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line,
        ]);
    }

    /**
     * Deletes an existing Journalissue model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Journalissue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Journalissue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Journalissue::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFinditem()
    {
        $html = '';
        $has_data = 0;
        //$model = \backend\models\Workqueue::find()->where(['is_invoice' => 0])->all();
        // $model = \backend\models\Stocksum::find()->where(['warehouse_id' => 7])->all();
        $model = \backend\models\Stocksum::find()->all();
        if ($model) {
            $has_data = 1;
            foreach ($model as $value) {
                $onhand_qty = $value->qty;
                $code = \backend\models\Product::findCode($value->product_id);
                $name = \backend\models\Product::findName($value->product_id);
                $price = \backend\models\Product::findPrice($value->product_id);
                $warehouse_name = \backend\models\Warehouse::findName($value->warehouse_id);
                $unit_id = \backend\models\Product::findUnitId($value->product_id);
                $unit_name = \backend\models\Unit::findName($unit_id);
                $html .= '<tr>';
                $html .= '<td style="text-align: center">
                            <div class="btn btn-outline-success btn-sm" onclick="addselecteditem($(this))" data-var="' . $value->product_id . '">เลือก</div>
                            <input type="hidden" class="line-find-item-id" value="' . $value->product_id . '">
                            <input type="hidden" class="line-find-item-code" value="' . $code . '">
                            <input type="hidden" class="line-find-item-name" value="' . $name . '">
                            <input type="hidden" class="line-find-onhand-qty" value="' . $onhand_qty . '">
                            <input type="hidden" class="line-find-warehouse-id" value="' . $value->warehouse_id . '">
                            <input type="hidden" class="line-find-warehouse-name" value="' . $warehouse_name . '">
                            <input type="hidden" class="line-find-price" value="' . $price . '">
                            <input type="hidden" class="line-find-unit-id" value="' . $unit_id . '">
                            <input type="hidden" class="line-find-unit-name" value="' . $unit_name . '">
                           </td>';
                $html .= '<td style="text-align: left">' . $code . '</td>';
                $html .= '<td style="text-align: left">' . $name . '</td>';
                $html .= '<td style="text-align: left">' . $warehouse_name . '</td>';
                $html .= '<td style="text-align: left">' . $onhand_qty . '</td>';
                $html .= '</tr>';
            }
        }

        if ($has_data == 0) {
            $html .= '<tr>';
            $html .= '<td colspan="5" style="text-align: center;color: red;">ไม่พบข้อมูล</td>';
            $html .= '</tr>';
        }
        echo $html;
    }

    public function actionFindexpdate()
    {
        $warehouse_id = \Yii::$app->request->post('warehouse_id');
        $product_id = \Yii::$app->request->post('product_id');

        $html = '';
        if ($warehouse_id != null && $product_id != null) {
            $model = \common\models\StockSum::find()->where(['product_id' => $product_id, 'warehouse_id' => $warehouse_id])->andFilterWhere(['>', 'qty', 0])->all();
            if ($model) {
                $html .= '<option value="">เลือกวันหมดอายุ</option>';
                foreach ($model as $key => $value) {
                    $html .= '<option value="' . $value->id . '" data-foo="' . $value->qty . '">' . date('d/m/Y', strtotime($value->expired_date)) . '</option>';
                }
            }
        }
        echo $html;
    }

    public function actionPrint($id)
    {
        if ($id != null) {
            $model = $this->findModel($id);
            $model_line = \common\models\JouranlIssueLine::find()->where(['journal_issue_id' => $id])->all();
            return $this->render('_print', [
                'model' => $model,
                'model_line' => $model_line
            ]);
        }
    }

    public function createDeliveryorder($id)
    {
        if ($id) {
            $model = \common\models\JouranlIssueLine::find()->where(['journal_issue_id' => $id])->all();
            if ($model) {

                $model_do = new \backend\models\Deliveryorder();
                $model_do->order_no = $model_do::getLastNo();
                $model_do->trans_date = date('Y-m-d H:i:s');
                $model_do->issue_ref_id = $id;
                $model_do->status = 0;
                if ($model_do->save(false)) {
                    foreach ($model as $key => $value) {
                        $model_line = new \common\models\DeliveryOrderLine();
                        $model_line->delivery_order_id = $model_do->id;
                        $model_line->product_id = $value->product_id;
                        $model_line->name = \backend\models\Product::findName($value->product_id);
                        $model_line->qty = $value->qty;
                        $model_line->save(false);
                    }
                }

            }
        }
    }

    public function notifymessage($issue_id, $journal_no, $user_id)
    {
        if ($issue_id > 0) {
            //$message = "This is test send request from camel paperless";
            $line_api = 'https://notify-api.line.me/api/notify';
            $line_token = '';
            $b_token = '';
          //  $b_token = '8H8dtjz5QWvWWBFrMAwYrglYhkwu3Pw7rnXeBK9vYFK';
            $line_token = trim($b_token);


            $journal_detail = '';
            $user_name = \backend\models\User::findName($user_id);
            $model_line = \common\models\JouranlIssueLine::find()->where(['journal_issue_id' => $issue_id])->all();
            if ($model_line) {
                foreach ($model_line as $value) {
                    $product_code = \backend\models\Product::findSku($value->product_id);
                    $product_name = \backend\models\Product::findName($value->product_id);

                    $journal_detail .= $product_code . ' ' . $product_name . ' ' . number_format($value->qty) . "\n";
                }
            }

            $message = '' . "\n";
            $message .= 'แจ้งเตือนรับเข้าสินค้า' . "\n";
            $message .= 'พนักงาน:' . $user_name . "\n";
            //   $message .= 'User:' . \backend\models\User::findName($user_id) . "\n";
            $message .= "วันที่:" . date('Y-m-d') . "(" . date('H:i:s') . ")" . "\n";

            $message .= 'เลขที่รับเบิก: ' . $journal_no . "\n";
            $message .= "รายละเอียด: \n " . $journal_detail . "\n";

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
