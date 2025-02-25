<?php

namespace backend\controllers;

use backend\models\Job;
use backend\models\JobSearch;
use backend\models\TeamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JobController implements the CRUD actions for Job model.
 */
class JobController extends Controller
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
     * Lists all Job models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new JobSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Job model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model_line = \common\models\JobLine::find()->where(['job_id'=>$id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'model_line' => $model_line,
        ]);
    }

    /**
     * Creates a new Job model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Job();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $line_product_id = \Yii::$app->request->post('line_product_id');
                $line_product_name = \Yii::$app->request->post('line_product_name');
                $line_cost_per_unit  = \Yii::$app->request->post('line_cost_per_unit');
                $line_discount = \Yii::$app->request->post('line_discount');
                $line_dealer_price = \Yii::$app->request->post('line_dealer_price');
                $line_vat = \Yii::$app->request->post('line_vat');
                $line_total_cost_per_unit = \Yii::$app->request->post('line_total_cost_per_unit');
                $line_qty = \Yii::$app->request->post('line_qty');
                $line_total_cost_all = \Yii::$app->request->post('line_total_cost_all');
                $line_quote_per_unit = \Yii::$app->request->post('line_quote_per_unit');
                $line_total_quote_price = \Yii::$app->request->post('line_total_quote_price');

                $trans_date = date('Y-m-d H:is');
                $xdate = explode('-',$model->trans_date);
                if($xdate!=null){
                    if(count($xdate)>1){
                        $trans_date = $xdate[2].'/'.$xdate[1].'/'.$xdate[0];
                    }
                }

                $model->trans_date = date('Y-m-d',strtotime($trans_date));

                if($model->save(false)){
                    if($line_product_id!=null){
                        if(count($line_product_id) > 0){
                            for($i = 0; $i <= count($line_product_id)-1; $i++){
                                $model_line = new \common\models\JobLine();
                                $model_line->job_id = $model->id;
                                $model_line->product_id = $line_product_id[$i];
                                $model_line->product_name = $line_product_name[$i];
                                $model_line->cost_per_unit = $line_cost_per_unit[$i];
                                $model_line->discount_per = $line_discount[$i];
                                $model_line->dealer_price = $line_dealer_price[$i];
                                $model_line->vat_amount = $line_vat[$i];
                                $model_line->total_cost_per_unit = $line_total_cost_per_unit[$i];
                                $model_line->qty = $line_qty[$i];
                                $model_line->cost_total = $line_total_cost_all[$i];
                                $model_line->quotation_per_unit_price = $line_quote_per_unit[$i];
                                $model_line->total_quotation_price = $line_total_quote_price[$i];
                                $model_line->save(false);
                            }
                        }
                    }
                    \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'บันทึกข้อมูลเรียบร้อยแล้ว'));
                    return $this->redirect(['index']);
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
     * Updates an existing Job model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line = \common\models\JobLine::find()->where(['job_id'=>$id])->all();

        if ($model->load($this->request->post())) {

            $line_product_id = \Yii::$app->request->post('line_product_id');
            $line_product_name = \Yii::$app->request->post('line_product_name');
            $line_cost_per_unit  = \Yii::$app->request->post('line_cost_per_unit');
            $line_discount = \Yii::$app->request->post('line_discount');
            $line_dealer_price = \Yii::$app->request->post('line_dealer_price');
            $line_vat = \Yii::$app->request->post('line_vat');
            $line_total_cost_per_unit = \Yii::$app->request->post('line_total_cost_per_unit');
            $line_qty = \Yii::$app->request->post('line_qty');
            $line_total_cost_all = \Yii::$app->request->post('line_total_cost_all');
            $line_quote_per_unit = \Yii::$app->request->post('line_quote_per_unit');
            $line_total_quote_price = \Yii::$app->request->post('line_total_quote_price');

            $removelist = \Yii::$app->request->post('removelist');
            $rec_id = \Yii::$app->request->post('rec_id');

            //print_r($rec_id);return ;

            $trans_date = date('Y-m-d H:is');
            $xdate = explode('-',$model->trans_date);
            if($xdate!=null){
                if(count($xdate)>1){
                    $trans_date = $xdate[2].'/'.$xdate[1].'/'.$xdate[0];
                }
            }

            $model->trans_date = date('Y-m-d',strtotime($trans_date));


            if($model->save(false)){
                if($line_product_id!=null){
                    if(count($line_product_id) > 0){
                        for($i = 0; $i <= count($line_product_id) -1; $i++){

                            $check_has = \common\models\JobLine::find()->where(['job_id' => $model->id,'id' => $rec_id[$i]])->one();
                            if($check_has!=null){
                                $check_has->product_id = $line_product_id[$i];
                                $check_has->product_name = $line_product_name[$i];
                                $check_has->cost_per_unit = $line_cost_per_unit[$i];
                                $check_has->discount_per = $line_discount[$i];
                                $check_has->dealer_price = $line_dealer_price[$i];
                                $check_has->vat_amount = $line_vat[$i];
                                $check_has->total_cost_per_unit = $line_total_cost_per_unit[$i];
                                $check_has->qty = $line_qty[$i];
                                $check_has->cost_total = $line_total_cost_all[$i];
                                $check_has->quotation_per_unit_price = $line_quote_per_unit[$i];
                                $check_has->total_quotation_price = $line_total_quote_price[$i];
                                $check_has->save(false);
                            }else{
                                $model_line = new \common\models\JobLine();
                                $model_line->job_id = $model->id;
                                $model_line->product_id = $line_product_id[$i];
                                $model_line->product_name = $line_product_name[$i];
                                $model_line->cost_per_unit = $line_cost_per_unit[$i];
                                $model_line->discount_per = $line_discount[$i];
                                $model_line->dealer_price = $line_dealer_price[$i];
                                $model_line->vat_amount = $line_vat[$i];
                                $model_line->total_cost_per_unit = $line_total_cost_per_unit[$i];
                                $model_line->qty = $line_qty[$i];
                                $model_line->cost_total = $line_total_cost_all[$i];
                                $model_line->quotation_per_unit_price = $line_quote_per_unit[$i];
                                $model_line->total_quotation_price = $line_total_quote_price[$i];
                                $model_line->save(false);
                            }
                        }
                    }

                    if($removelist!=null || $removelist !=''){
                        $xp = explode(',',$removelist);
                        if(count($xp)>0){
                            for($x = 0; $x <= count($xp)-1; $x++){
                                \common\models\JobLine::deleteAll(['id' => $xp[$x]]);
                            }
                        }
                    }
                }
                \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'บันทึกข้อมูลเรียบร้อยแล้ว'));
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line,
        ]);
    }

    /**
     * Deletes an existing Job model.
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
     * Finds the Job model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Job the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Job::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
