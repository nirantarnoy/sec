<?php

namespace backend\controllers;

use backend\models\JournalissueSearch;
use backend\models\Journalreceive;
use backend\models\JournalreceiveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;

/**
 * JournalreceiveController implements the CRUD actions for Journalreceive model.
 */
class JournalreceiveController extends Controller
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
     * Lists all Journalreceive models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new JournalreceiveSearch();
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
     * Displays a single Journalreceive model.
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
     * Creates a new Journalreceive model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Journalreceive();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $line_item_id = \Yii::$app->request->post('line_product_id');
                $line_warehouse_id = \Yii::$app->request->post('line_product_warehouse_id');
                $line_qty = \Yii::$app->request->post('line_qty');
                $line_remark = \Yii::$app->request->post('line_remark');
                $line_exp_date = \Yii::$app->request->post('line_expire_date');

                $xdate = explode('-', $model->trans_date);
                $t_date = date('Y-m-d');
                if (count($xdate) > 1) {
                    $t_date = $xdate[2] . '-' . $xdate[1] . '-' . $xdate[0];
                }
                $model->journal_no = Journalreceive::getLastNo();
                $model->trans_date = date('Y-m-d H:i:s', strtotime($t_date));
                //$model->status = 0;
                if($model->save(false)){
                    if ($line_item_id != null) {
                        for ($i = 0; $i <= count($line_item_id) - 1; $i++) {

//                            $xdate = explode('/',$line_exp_date[$i]);
//                            $exp_date = date('Y-m-d');
//                            if($xdate!=null){
//                                $exp_date = $xdate[2].'/'.$xdate[1].'/'.$xdate[0];
//                            }

                            $model_line = new \common\models\JouranlReceiveLine();
                            $model_line->journal_rec_id = $model->id;
                            $model_line->product_id = $line_item_id[$i];
                            $model_line->qty = $line_qty[$i];
                            $model_line->status = 0;
                            $model_line->remark = $line_remark[$i];
                            if ($model_line->save(false)) {
                                $model_trans = new \backend\models\Stocktrans();
                                $model_trans->journal_no = $model->journal_no;
                                $model_trans->trans_date = date('Y-m-d H:i:s');
                                $model_trans->product_id = $line_item_id[$i];
                                $model_trans->qty = (float)$line_qty[$i];
                                $model_trans->activity_type_id = 4; // 5 is receive
                                $model_trans->stock_type_id = 1; // 1 = in , 2 = out
                                $model_trans->warehouse_id = $line_warehouse_id[$i];
                                $model_trans->trans_ref_id = $model->id;
                                if ($model_trans->save(false)) {
                                    $model_stock = \backend\models\Stocksum::find()->where(['product_id' => $line_item_id[$i], 'warehouse_id' => $line_warehouse_id[$i]])->one();
                                    if ($model_stock) {
                                        $model_stock->qty = (float)$model_stock->qty + (float)$line_qty[$i];
                                        $model_stock->save(false);
                                    } else {
                                        $model_new = new \backend\models\Stocksum();
                                        $model_new->product_id = $line_item_id[$i];
                                        $model_new->warehouse_id = $line_warehouse_id[$i];
                                        $model_new->qty = (float)$line_qty[$i];
                                        $model_new->save(false);
                                    }
                                }
                            }
                        }
                    }
                    //$this->notifymessage($model->id,$model->journal_no,$model->created_by);
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
     * Updates an existing Journalreceive model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line = \common\models\JouranlReceiveLine::find()->where(['journal_rec_id' => $id])->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line,
        ]);
    }

    /**
     * Deletes an existing Journalreceive model.
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
     * Finds the Journalreceive model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Journalreceive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Journalreceive::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function notifymessage($receive_id,$journal_no,$user_id)
    {
        if($receive_id > 0){
            //$message = "This is test send request from camel paperless";
            $line_api = 'https://notify-api.line.me/api/notify';
            $line_token = '';
            $b_token = '';
          //      $b_token = '8H8dtjz5QWvWWBFrMAwYrglYhkwu3Pw7rnXeBK9vYFK';
            $line_token = trim($b_token);


            $journal_detail = '';
           $user_name = \backend\models\User::findName($user_id);
           $model_line = \common\models\JouranlReceiveLine::find()->where(['journal_rec_id'=>$receive_id])->all();
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

            $message .= 'เลขที่รับเข้า: ' .$journal_no. "\n";
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
