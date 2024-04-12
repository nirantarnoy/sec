<?php

namespace backend\controllers;

use backend\models\CostTitleSearch;
use backend\models\WorkOptionType;
use backend\models\WorkOptionTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkoptiontypeController implements the CRUD actions for WorkOptionType model.
 */
class WorkoptiontypeController extends Controller
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
     * Lists all WorkOptionType models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new WorkOptionTypeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single WorkOptionType model.
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
     * Creates a new WorkOptionType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new WorkOptionType();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $worktype_payment_tax_id = \Yii::$app->request->post('customer_tax_id');
                $worktype_payment_tax_branch = \Yii::$app->request->post('customer_tax_branch');
                $worktype_payment_tax_email = \Yii::$app->request->post('customer_tax_email');
                $worktype_payment_tax_contact_name = \Yii::$app->request->post('customer_tax_contact_name');
                $worktype_payment_tax_phone = \Yii::$app->request->post('customer_tax_phone');
                $worktype_payment_tax_address = \Yii::$app->request->post('customer_tax_address');

                $worktype_payment_tax_paymentterm = \Yii::$app->request->post('customer_payment_term_id');
                $worktype_payment_tax_paymentmethod = \Yii::$app->request->post('customer_payment_method_id');

                if($model->save()){
                    if($worktype_payment_tax_id != ''){
                        $model_tax = new \common\models\WorkTypeInvoiceInfo();
                        $model_tax->work_type_id = $model->id;
                        $model_tax->tax_id = $worktype_payment_tax_id;
                        $model_tax->branch = $worktype_payment_tax_branch;
                        $model_tax->email = $worktype_payment_tax_email;
                        $model_tax->contact_name = $worktype_payment_tax_contact_name;
                        $model_tax->phone = $worktype_payment_tax_phone;
                        $model_tax->address = $worktype_payment_tax_address;
                        $model_tax->payment_term_id = $worktype_payment_tax_paymentterm;
                        $model_tax->payment_method_id = $worktype_payment_tax_paymentmethod;
                        $model_tax->status = 1;
                        $model_tax->save(false);
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
     * Updates an existing WorkOptionType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model_worktype_tax_info = \common\models\WorkTypeInvoiceInfo::find()->where(['work_type_id'=>$id])->one();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $worktype_payment_tax_id = \Yii::$app->request->post('customer_tax_id');
            $worktype_payment_tax_branch = \Yii::$app->request->post('customer_tax_branch');
            $worktype_payment_tax_email = \Yii::$app->request->post('customer_tax_email');
            $worktype_payment_tax_contact_name = \Yii::$app->request->post('customer_tax_contact_name');
            $worktype_payment_tax_phone = \Yii::$app->request->post('customer_tax_phone');
            $worktype_payment_tax_address = \Yii::$app->request->post('customer_tax_address');
            $worktype_payment_tax_paymentterm = \Yii::$app->request->post('customer_payment_term_id');
            $worktype_payment_tax_paymentmethod = \Yii::$app->request->post('customer_payment_method_id');
            if($model->save()) {
                if ($worktype_payment_tax_id != '') {
                    $model_tax_check = \common\models\WorkTypeInvoiceInfo::find()->where(['work_type_id' => $model->id])->one();
                    if ($model_tax_check) {
                        $model_tax_check->tax_id = $worktype_payment_tax_id;
                        $model_tax_check->branch = $worktype_payment_tax_branch;
                        $model_tax_check->email = $worktype_payment_tax_email;
                        $model_tax_check->contact_name = $worktype_payment_tax_contact_name;
                        $model_tax_check->phone = $worktype_payment_tax_phone;
                        $model_tax_check->address = $worktype_payment_tax_address;
                        $model_tax_check->payment_term_id = $worktype_payment_tax_paymentterm;
                        $model_tax_check->payment_method_id = $worktype_payment_tax_paymentmethod;
                        $model_tax_check->save(false);
                    } else {
                        $model_tax = new \common\models\WorkTypeInvoiceInfo();
                        $model_tax->work_type_id = $model->id;
                        $model_tax->tax_id = $worktype_payment_tax_id;
                        $model_tax->branch = $worktype_payment_tax_branch;
                        $model_tax->email = $worktype_payment_tax_email;
                        $model_tax->contact_name = $worktype_payment_tax_contact_name;
                        $model_tax->phone = $worktype_payment_tax_phone;
                        $model_tax->address = $worktype_payment_tax_address;
                        $model_tax->payment_term_id = $worktype_payment_tax_paymentterm;
                        $model_tax->payment_method_id = $worktype_payment_tax_paymentmethod;
                        $model_tax->status = 1;
                        $model_tax->save(false);
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'model_work_type_tax_info'=>$model_worktype_tax_info,
        ]);
    }

    /**
     * Deletes an existing WorkOptionType model.
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
     * Finds the WorkOptionType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return WorkOptionType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WorkOptionType::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
