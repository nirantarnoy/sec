<?php

namespace backend\controllers;

use backend\models\Advancetable;
use backend\models\AdvancetableSearch;
use backend\models\Cashadvance;
use common\models\AdvanceMaster;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdvancetableController implements the CRUD actions for Advancetable model.
 */
class AdvancetableController extends Controller
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
     * Lists all Advancetable models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AdvancetableSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Advancetable model.
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
     * Creates a new Advancetable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Advancetable();
        $model_line = new Cashadvance();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save(true)) {
                //return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect(['update', 'id' => $model->id]);
            }

            if($model_line->load($this->request->post())){

            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'model_line' => $model_line
        ]);
    }

    /**
     * Updates an existing Advancetable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line = new Cashadvance();
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
           // return $this->redirect(['view', 'id' => $model->id]);
//            return $this->redirect(['update', 'id' => $model->id]);
            if($model_line->load($this->request->post())){
                $xdate = explode('-', $model_line->trans_date);
                $tdate = date('Y-m-d');
                if ($xdate != null) {
                    if (count($xdate) > 1) {
                        $tdate = $xdate[2] . '/' . $xdate[1] . '/' . $xdate[0];
                    }
                }

                $line_balance = 0; // ($model_line->in_amount - $model_line->out_amount);

                $model_old = Cashadvance::find()->where(['advance_master_id'=>$model->id])->all();
                if($model_old != null){
                    foreach($model_old as $value){
                        $line_balance += ($value->in_amount - $value->out_amount);
                    }
                }

                $line_balance = $line_balance +($model_line->in_amount - $model_line->out_amount);

                if($model_line->name != "" ){
                    $model_line->trans_date = date('Y-m-d',strtotime($tdate));
                    $model_line->balance_amount = $line_balance;
                    $model_line->quotation_ref_no = \Yii::$app->request->post('quotation_tags');
                    if($model_line->save(false)){
                        \common\models\AdvanceMaster::updateAll(['total_balance' => $line_balance], ['id' => $model->id]);
                        return $this->redirect(['update', 'id' => $model->id]);
                    }
                }

            }
        }



        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line
        ]);
    }

    /**
     * Deletes an existing Advancetable model.
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
     * Finds the Advancetable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Advancetable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Advancetable::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDeletecashadvance(){
        $line_id = \Yii::$app->request->post('line_id');
        if($line_id != null){
            $model = \common\models\CashAdvance::find()->select(['advance_master_id'])->where(['id'=>$line_id])->one();
            \common\models\CashAdvance::deleteAll(['id'=>$line_id]);

            $line_balance = 0;

            if($model){
                $model_old = Cashadvance::find()->where(['advance_master_id'=>$model->advance_master_id])->all();
                if($model_old != null){
                    foreach($model_old as $value){
                        $line_balance += ($value->in_amount - $value->out_amount);
                        \backend\models\Cashadvance::updateAll(['balance_amount' => $line_balance], ['id' => $value->id]);
                    }
                }

                \common\models\AdvanceMaster::updateAll(['total_balance' => $line_balance], ['id' => $model->advance_master_id]);
            }



        }
        echo "ok";
    }

    public function actionCreatecustomer(){
        $new_id = 0;
        $html= '';
        $name = \Yii::$app->request->post('name');
        $description = \Yii::$app->request->post('description');
        $is_saved = 0;
        if($name){

            $model_check_dup = \backend\models\Customer::find()->where(['name'=>$name])->one();
            if($model_check_dup){
               $html = 'duplicate';
            }else{
                $model = new \common\models\Customer();
                $model->name = $name;
                $model->description = $description;
                $model->status = 1;
                $model->can_new = 0;
                if($model->save(false)){
                    $is_saved = 1;
                    $new_id = $model->id;
                    $model_list = \backend\models\Customer::find()->where(['status'=>1])->orderBy(['can_new'=>SORT_ASC])->all();
                    if($model_list){
                        foreach($model_list as $value){
                            $selected = '';
                            if($value->id == $new_id){
                                $selected = 'selected';
                            }
                            $html .= '<option value="'.$value->id.'" '.$selected.'>'.$value->name.'</option>';
                        }
                    }
                }
            }


        }
        echo $html;
    }
}
