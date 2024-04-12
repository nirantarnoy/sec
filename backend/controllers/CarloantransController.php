<?php

namespace backend\controllers;

use backend\models\Carloantrans;
use backend\models\CarloantransSearch;
use backend\models\CartypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CarloantransController implements the CRUD actions for Carloantrans model.
 */
class CarloantransController extends Controller
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
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Carloantrans models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");

        $searchModel = new CarloantransSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Carloantrans model.
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
     * Creates a new Carloantrans model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Carloantrans();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $filename = '';
                $uploaded = UploadedFile::getInstance($model,'doc');
                if(!empty($uploaded)){
                    $upfiles = time() . "." . $uploaded->getExtension();
                    if ($uploaded->saveAs('../web/uploads/files/carloan/' . $upfiles)) {
                        $filename = $upfiles;
                    }
                }

                $xdate = explode('/', trim($model->trans_date));
                $t_date = date('Y-m-d');
                if (count($xdate) > 1) {
                    $t_date = $xdate[2] . '-' . $xdate[1] . '-' . $xdate[0];
                  //  echo date('Y-m-d',strtotime($t_date));
                }
              //  return;

                $model->doc = $filename;
                $model->trans_date = date('Y-m-d',strtotime($t_date));
                $model->status = 1;
                if($model->save(false)){
                    return $this->redirect(['carloantrans/index']);
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
     * Updates an existing Carloantrans model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $xdate = explode('/', trim($model->trans_date));
            $t_date = date('Y-m-d');
            if (count($xdate) > 1) {
                  $t_date = $xdate[2] . '-' . $xdate[1] . '-' . $xdate[0];
                //echo date('Y-m-d',strtotime($model->trans_date));
            }
            $model->trans_date = date('Y-m-d',strtotime($t_date));
            $model->status = 1;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Carloantrans model.
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
     * Finds the Carloantrans model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Carloantrans the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Carloantrans::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFindcustomerdata(){
        $data = [];
        $id = \Yii::$app->request->post('car_id');
        if($id){
              $model = \common\models\CarLoan::find()->where(['car_id'=>$id])->one();
              if($model){
                  $period_no = 1;
                  $model_trans = \common\models\CarLoanTrans::find()->where(['car_loan_id'=>$id])->count();
                  if($model_trans){
                      $period_no = ($model_trans + 1);
                  }
                  array_push($data,['payment_std_amt'=>$model->period_amount,'period_count'=>$model->total_period,'period_no'=>$period_no,'loan_doc_no'=>$model->doc_no]);
              }
        }
        echo json_encode($data);
    }
}
