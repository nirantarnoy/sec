<?php

namespace backend\controllers;

use backend\models\Order;
use backend\models\OrderSearch;
use backend\models\PositionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
            ]
        );
    }

    /**
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $viewstatus = 1;

        if(\Yii::$app->request->get('viewstatus')!=null){
            $viewstatus = \Yii::$app->request->get('viewstatus');
        }

        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new OrderSearch();
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
            'viewstatus'=>$viewstatus,
        ]);
    }

    /**
     * Displays a single Order model.
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
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Order();

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
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line = \common\models\OrderLine::find()->where(['order_id' => $id])->all();


        if ($this->request->isPost && $model->load($this->request->post())) {
            $status = 0;
            if($model->order_tracking_no !=''){
                $status = 3;
            }
            $model->status = $status;
            if($model->save(false)){
                return $this->redirect(['order/index']);
            }

        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line,
        ]);
    }

    /**
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCreateissue(){
       $order_id = \Yii::$app->request->get('order_id');
       if($order_id){
           $model = new \backend\models\Journalissue();
           $model->journal_no = $model::getLastNo();
           $model->issue_for_id = $order_id;
           $model->trans_date = date('Y-m-d H:i:s');
           $model->status = 0;
           if($model->save(false)){
               $order_data = \common\models\OrderLine::find()->where(['order_id'=>$order_id])->all();
               if($order_data){
                   foreach ($order_data as $key => $value) {
                       $model_line = new \common\models\JouranlIssueLine();
                       $model_line->journal_issue_id = $model->id;
                       $model_line->product_id = $value->product_id;
                       $model_line->qty = $value->qty;
                       $model_line->price = $value->price;
                       $model_line->status = 0;
                       $model_line->save(false);
                   }
               }
           }
       }
       return $this->redirect(['order/update','id'=>$order_id]);
    }
    public function actionCreateinvoice(){
        $order_id = \Yii::$app->request->get('order_id');
        if($order_id){
            $model = new \backend\models\Customerinvoice();
            $model->invoice_no = $model::getLastNo();
            $model->order_ref_id = $order_id;
            $model->trans_date = date('Y-m-d H:i:s');
            $model->status = 0;
            if($model->save(false)){
                $order_data = \common\models\OrderLine::find()->where(['order_id'=>$order_id])->all();
                if($order_data){
                    foreach ($order_data as $key => $value) {
                        $model_line = new \common\models\CustomerInvoiceLine();
                        $model_line->customer_invoice_id = $model->id;
                        $model_line->product_id = $value->product_id;
                        $model_line->qty = $value->qty;
                        $model_line->price = $value->price;
                        $model_line->status = 0;
                        $model_line->save(false);
                    }
                }
            }
        }
        return $this->redirect(['order/update','id'=>$order_id]);
    }
    public function actionNotifymessage()
    {
        //$message = "This is test send request from camel paperless";
        $line_api = 'https://notify-api.line.me/api/notify';
        $line_token = '';


        $b_token = '8H8dtjz5QWvWWBFrMAwYrglYhkwu3Pw7rnXeBK9vYFK';
        $line_token = trim($b_token);

        $message = '' . "\n";
        $message .= 'ANNAB: แจ้งเตือนมีคำสั่งซื้อใหม่' . "\n";
        $message .= 'ลูกค้า :' . 'คุณทดสอบ' . "\n";
        //   $message .= 'User:' . \backend\models\User::findName($user_id) . "\n";
        $message .= "วันที่: " . date('Y-m-d') . "(" . date('H:i:s') . ")" . "\n";

        $message .= 'เลขที่คำสั่งซื้อ: ' .'SO2405-00001'. "\n";
        $message .= "ยอดเงิน: " . number_format(15000, 2) . "\n";

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
