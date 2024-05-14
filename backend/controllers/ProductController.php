<?php

namespace backend\controllers;

use backend\models\Product;
use backend\models\ProductSearch;
use backend\models\WarehouseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public $enableCsrfValidation = false;

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
                        'delete' => ['POST', 'GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Product models.
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
        $searchModel = new ProductSearch();
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
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $line_warehouse = \Yii::$app->request->post('warehouse_id');
                $line_qty = \Yii::$app->request->post('line_qty');
                $line_exp_date = \Yii::$app->request->post('line_exp_date');

                if ($model->save(false)) {
                    $uploaded = UploadedFile::getInstanceByName('product_photo');
                    $uploaded2 = UploadedFile::getInstanceByName('product_photo_2');

                    if (!empty($uploaded)) {
                        $upfiles = "photo_" . time() . "." . $uploaded->getExtension();
                        if ($uploaded->saveAs('uploads/product_photo/' . $upfiles)) {
                            \backend\models\Product::updateAll(['photo' => $upfiles], ['id' => $model->id]);
                        }

                    }
                    if (!empty($uploaded2)) {
                        $upfiles2 = "photo_" . time() . "." . $uploaded2->getExtension();
                        if ($uploaded2->saveAs('uploads/product_photo/' . $upfiles2)) {
                            \backend\models\Product::updateAll(['photo_2' => $upfiles2], ['id' => $model->id]);
                        }

                    }

                    if($line_warehouse != null){
                        for($i=0;$i<count($line_warehouse);$i++){
                            if($line_qty[$i] == 0){
                                continue;
                            }
                            $xdate = explode('/',$line_exp_date[$i]);
                            $exp_date = date('Y-m-d');
                            if($xdate!=null){
                                $exp_date = $xdate[2].'/'.$xdate[1].'/'.$xdate[0];
                            }

                            $model_trans = new \backend\models\Stocktrans();
                            $model_trans->product_id = $model->id;
                            $model_trans->trans_date = date('Y-m-d H:i:s');
                            $model_trans->activity_type_id = 1; // 1 ปรับสต๊อก 2 รับเข้า 3 จ่ายออก
                            $model_trans->qty = $line_qty[$i];
                            $model_trans->status = 1;
                            if($model_trans->save(false)){
                                $model_sum = \backend\models\Stocksum::find()->where(['product_id'=>$model->id,'warehouse_id'=>$line_warehouse[$i],'expired_date'=>date('Y-m-d',strtotime($exp_date))])->one();
                                if($model_sum){
                                    $model_sum->qty = $line_qty[$i];
                                    $model_sum->save(false);
                                }else{
                                    $model_sum = new \backend\models\Stocksum();
                                    $model_sum->product_id = $model->id;
                                    $model_sum->warehouse_id = $line_warehouse[$i];
                                    $model_sum->qty = $line_qty[$i];
                                    $model_sum->expired_date = date('Y-m-d',strtotime($exp_date));
                                    $model_sum->save(false);
                                }
                            }
                        }
                    }
                }

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
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line = \common\models\StockSum::find()->where(['product_id'=>$id])->all();
        $work_photo = '';
        if ($this->request->isPost && $model->load($this->request->post())) {

            $line_warehouse = \Yii::$app->request->post('warehouse_id');
            $line_qty = \Yii::$app->request->post('line_qty');
            $line_exp_date = \Yii::$app->request->post('line_exp_date');

            $uploaded = UploadedFile::getInstanceByName('product_photo');
            $uploaded2 = UploadedFile::getInstanceByName('product_photo_2');

            $line_rec_id = \Yii::$app->request->post('line_rec_id');
            $removelist = \Yii::$app->request->post('remove_list');

            //  print_r($line_warehouse);return;

            if ($model->save(false)) {
                if (!empty($uploaded)) {
                    $upfiles = "photo_" . time() . "." . $uploaded->getExtension();
                    if ($uploaded->saveAs('uploads/product_photo/' . $upfiles)) {
                        \backend\models\Product::updateAll(['photo' => $upfiles], ['id' => $model->id]);
                    }

                }
                if (!empty($uploaded2)) {
                    $upfiles2 = "photo_" . time() . "." . $uploaded2->getExtension();
                    if ($uploaded2->saveAs('uploads/product_photo/' . $upfiles2)) {
                        \backend\models\Product::updateAll(['photo_2' => $upfiles2], ['id' => $model->id]);
                    }

                }
                for($i=0;$i<count($line_warehouse);$i++){
                    if($line_qty[$i] == 0){
                        continue;
                    }
                    $xdate = explode('/',$line_exp_date[$i]);
                    $exp_date = date('Y-m-d');
                    if($xdate!=null){
                        $exp_date = $xdate[2].'/'.$xdate[1].'/'.$xdate[0];
                    }
                    $model_trans = new \backend\models\Stocktrans();
                    $model_trans->product_id = $model->id;
                    $model_trans->trans_date = date('Y-m-d H:i:s');
                    $model_trans->activity_type_id = 1; // 1 ปรับสต๊อก 2 รับเข้า 3 จ่ายออก
                    $model_trans->qty = $line_qty[$i];
                    $model_trans->status = 1;
                    if($model_trans->save(false)){
                  //      $model_sum = \backend\models\Stocksum::find()->where(['product_id'=>$model->id,'warehouse_id'=>$line_warehouse[$i],'expired_date'=>date('Y-m-d',strtotime($exp_date))])->one();
                       if($line_rec_id[$i] != 0){

                           $model_sum = \backend\models\Stocksum::find()->where(['product_id'=>$model->id,'id'=>$line_rec_id[$i]])->one();
                           if($model_sum){
                               $model_sum->warehouse_id = $line_warehouse[$i];
                               $model_sum->expired_date = date('Y-m-d',strtotime($exp_date));
                               $model_sum->qty = $line_qty[$i];
                               $model_sum->save(false);
                           }
                       }else{
                           $model_sum_new = new \backend\models\Stocksum();
                           $model_sum_new->product_id = $model->id;
                           $model_sum_new->warehouse_id = $line_warehouse[$i];
                           $model_sum_new->qty = $line_qty[$i];
                           $model_sum_new->expired_date = date('Y-m-d',strtotime($exp_date));
                           $model_sum_new->save(false);
                       }

                    }
                }

                if($removelist!=null){
                    $xdel = explode(',', $removelist);
                    for($i=0;$i<count($xdel);$i++){
                        \backend\models\Stocksum::deleteAll(['id'=>$xdel[$i]]);
                    }
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'work_photo' => $work_photo,
            'model_line' => $model_line,
        ]);
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionImportpage()
    {
        return $this->render('_import');
    }
    public function actionImportproduct()
    {
        $uploaded = UploadedFile::getInstanceByName('file_import');
        if (!empty($uploaded)) {
            //echo "ok";return;
            $upfiles = time() . "." . $uploaded->getExtension();
            // if ($uploaded->saveAs(Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles)) {
            if ($uploaded->saveAs('../web/uploads/files/products/' . $upfiles)) {
                //  echo "okk";return;
                // $myfile = Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles;
                $myfile = '../web/uploads/files/products/' . $upfiles;
                $file = fopen($myfile, "r+");
                fwrite($file, "\xEF\xBB\xBF");

                setlocale(LC_ALL, 'th_TH.TIS-620');
                $i = -1;
                $res = 0;
                $data = [];
                while (($rowData = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $i += 1;
                    $catid = 0;
                    $qty = 0;
                    $price = 0;
                    $cost = 0;
                    if ($rowData[1] == '' || $i == 0) {
                        continue;
                    }

                    $model_dup = \backend\models\Product::find()->where(['sku' => trim($rowData[1])])->one();
                    if ($model_dup != null) {
                        continue;
                    }


                    $modelx = new \backend\models\Product();
                    // $modelx->code = $rowData[0];
                    $modelx->code = $rowData[2];
                    $modelx->sku = $rowData[2];
                    $modelx->name = $rowData[1];
                    $modelx->barcode = $rowData[3];
                    $modelx->total_qty = $rowData[4];
                    $modelx->sale_price = $rowData[5];
                    $modelx->status = 1;
                    if ($modelx->save(false)) {
                        $res += 1;
                    }
                }
                //    print_r($qty_text);return;

                if ($res > 0) {
                    $session = \Yii::$app->session;
                    $session->setFlash('msg', 'นำเข้าข้อมูลเรียบร้อย');
                    return $this->redirect(['index']);
                } else {
                    $session = \Yii::$app->session;
                    $session->setFlash('msg-error', 'พบข้อมผิดพลาดนะ');
                    return $this->redirect(['index']);
                }
                // }
                fclose($file);
//            }
//        }
            }
            echo "ok";
        }
    }
}
