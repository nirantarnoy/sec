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
                if ($model->save(false)) {
                    $uploaded = UploadedFile::getInstanceByName('product_photo');

                    if (!empty($uploaded)) {
                        $upfiles = "photo_" . time() . "." . $uploaded->getExtension();
                        if ($uploaded->saveAs('uploads/product_photo/' . $upfiles)) {
                            \backend\models\Product::updateAll(['photo' => $upfiles], ['id' => $model->id]);
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
        $work_photo = '';
        if ($this->request->isPost && $model->load($this->request->post())) {

            $uploaded = UploadedFile::getInstanceByName('product_photo');
            if ($model->save(false)) {
                if (!empty($uploaded)) {
                    $upfiles = "photo_" . time() . "." . $uploaded->getExtension();
                    if ($uploaded->saveAs('uploads/product_photo/' . $upfiles)) {
                        \backend\models\Product::updateAll(['photo' => $upfiles], ['id' => $model->id]);
                    }

                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'work_photo' => $work_photo,
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
