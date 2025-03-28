<?php

namespace backend\controllers;

use backend\models\Jobmain;
use backend\models\JobmainSearch;
use backend\models\JobSearch;
use backend\models\UnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JobmainController implements the CRUD actions for Jobmain model.
 */
class JobmainController extends Controller
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
                        'delete' => ['POST','GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Jobmain models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new JobmainSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['created_by'=>\Yii::$app->user->id]);
        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Jobmain model.
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
     * Creates a new Jobmain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Jobmain();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $trans_date = date('Y-m-d H:is');
                $xdate = explode('-', $model->job_month);
                if ($xdate != null) {
                    if (count($xdate) > 1) {
                        $trans_date = $xdate[2] . '/' . $xdate[1] . '/' . $xdate[0];
                    }
                }

                $model->job_month = date('Y-m-d', strtotime($trans_date));
                $model->approve_payment_status = 1;
                $model->status = 0;
                if($model->save()){
                    // return $this->redirect(['view', 'id' => $model->id]);
                    \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'บันทึกข้อมูลเรียบร้อยแล้ว'));
                 //   return $this->redirect(['index']);
                    return $this->redirect(['update', 'id' => $model->id]);
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
     * Updates an existing Jobmain model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new JobSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['job_master_id' => $id,'created_by'=>\Yii::$app->user->id]);
        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
        $dataProvider->pagination->pageSize = $pageSize;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
          //  return $this->redirect(['view', 'id' => $model->id]);
            \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'บันทึกข้อมูลเรียบร้อยแล้ว'));
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);

    }

    /**
     * Deletes an existing Jobmain model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'บันทึกข้อมูลเรียบร้อยแล้ว'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Jobmain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Jobmain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jobmain::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCreatejob(){
        $jobmain_id = \Yii::$app->request->post('id');
        $customer_id = \Yii::$app->request->post('customer_id');
        $tags = \Yii::$app->request->post('tags');
        $tags2 = \Yii::$app->request->post('tags2');
        $team_id = \Yii::$app->request->post('team_id');
        $head_id = \Yii::$app->request->post('head_id');

        if($jobmain_id){
            $model = new \backend\models\Job();
            $model->job_no = $model::getLastNo();
            $model->trans_date = date('Y-m-d');
            $model->job_master_id = $jobmain_id;
            $model->customer_id = $customer_id;
            $model->quotation_ref_no = $tags;
            $model->invoice_ref_no = $tags2;
            $model->team_id = $team_id;
            $model->head_id = $head_id;
            $model->payment_status = 1;
            $model->status = 1;
            $model->job_value_amount = 0;
            if($model->save(false)){
                \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'บันทึกข้อมูลเรียบร้อยแล้ว'));
                return $this->redirect(['jobmain/update','id'=>$jobmain_id]);
            }
        }
    }
}
