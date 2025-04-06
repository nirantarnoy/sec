<?php

namespace backend\controllers;

use backend\models\Unit;
use backend\models\UnitSearch;
use backend\models\UsergroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UnitController implements the CRUD actions for Unit model.
 */
class PerformancechartController extends Controller
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
     * Lists all Unit models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $selected_year = null;
        $selected_month = null;

        $selected_year = \Yii::$app->request->post("selected_year");
        $selected_month = \Yii::$app->request->post("selected_month");
        if($selected_year == null && $selected_month == null){
            $selected_year = date('Y');
            $selected_month = (int)date('m');
        }
        return $this->render('index', [
            'selected_year' => $selected_year,
            'selected_month' => $selected_month,
        ]);
    }

    /**
     * Displays a single Unit model.
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
     * Creates a new Unit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Unit();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                // return $this->redirect(['view', 'id' => $model->id]);
                \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'บันทึกข้อมูลเรียบร้อยแล้ว'));
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Unit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'บันทึกข้อมูลเรียบร้อยแล้ว'));
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Unit model.
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
     * Finds the Unit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Unit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Unit::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpdatekpi()
    {
        $perform_year = \Yii::$app->request->post("perform_year");
        $perform_month = \Yii::$app->request->post("perform_month");
        $team_id = \Yii::$app->request->post("team_id");


        $line_emp_id = \Yii::$app->request->post('line_emp_id');
        $line_sale_value_amount = \Yii::$app->request->post('line_sale_value_amount');
        $line_sale_per_amount = \Yii::$app->request->post('line_sale_per_amount');
        $line_profit_amount = \Yii::$app->request->post('line_profit_amount');
        $line_profit_per = \Yii::$app->request->post('line_profit_per');
        $line_job_count = \Yii::$app->request->post('line_job_count');
        $line_job_count_per = \Yii::$app->request->post('line_job_count_per');
        $line_attendance = \Yii::$app->request->post('line_attendance');
        $line_personal_perform = \Yii::$app->request->post('line_personal_perform');
        $line_job_high_per = \Yii::$app->request->post('line_job_high_per');
        $line_job_low_per = \Yii::$app->request->post('line_job_low_per');

//// kpi section

        $line_kpi_rating = \Yii::$app->request->post("line_kpi_rating");
        $line_kpi_personal_goal = \Yii::$app->request->post("line_kpi_personal_goal");
        $line_kpi_high_performance = \Yii::$app->request->post("line_kpi_high_performance");
        $line_kpi_minimum = \Yii::$app->request->post("line_kpi_minimum");
        $line_kpi_low_performance = \Yii::$app->request->post("line_kpi_low_performance");
        $line_kpi_title_id = \Yii::$app->request->post('line_kpi_title_id');

        $line_kpi_high_total = \Yii::$app->request->post('line_kpi_high_total');
        $line_kpi_low_total = \Yii::$app->request->post('line_kpi_low_total');

        ///// team target
        $target_personal_data = [];
        $team_member = \common\models\TeamLine::find()->where(['team_id' => 1])->orderBy(['emp_id' => SORT_ASC])->all();

        $line_milestone = \Yii::$app->request->post('line_milestone');
        $line_monthly_target = \Yii::$app->request->post('line_monthly_target');
        $line_tele_sell_target = \Yii::$app->request->post('line_tele_sell_target');
        $line_install_target = \Yii::$app->request->post('line_install_target');

        $loop_emp_num =0;
        foreach ($team_member as $value_member){
            $loop_emp_num+=1;
            $loop_emp_id = \Yii::$app->request->post('line_personal_emp_id'.$loop_emp_num);
            $loop_emp_target = \Yii::$app->request->post('line_personal_target'.$loop_emp_num);
            array_push($target_personal_data,['emp_id'=>$loop_emp_id,'target'=>$loop_emp_target]);
        }
        // echo count($target_personal_data);return;
        //print_r($target_personal_data[1]);return;


        $line_ttar = \Yii::$app->request->post('line_ttar');
        $line_ptar = \Yii::$app->request->post('line_ptar');


        if($perform_year && $team_id){
            $model_check_target_year = \common\models\TeamTargetYear::find()->where(['target_year'=>$perform_year,'team_id'=>$team_id])->one();
            if($model_check_target_year){
                if($line_milestone!=null){
                    \common\models\TeamTarget::deleteAll(['target_year_id'=>$model_check_target_year->id]);
                    \common\models\TeamPersonalTarget::deleteAll(['target_year_id'=>$model_check_target_year->id]);
                    for($a=0;$a<=count($line_milestone)-1;$a++){
                        $model_new_target = new \common\models\TeamTarget();
                        $model_new_target->target_year_id = $model_check_target_year->id;
                        $model_new_target->milestone = $line_milestone[$a];
                        $model_new_target->monthly_amount = str_replace(",","",$line_monthly_target[$a]);
                        $model_new_target->tele_sell_amount = str_replace(",","",$line_tele_sell_target[$a]);
                        $model_new_target->installation_amount = str_replace(",","",$line_install_target[$a]);
                        $model_new_target->ttar_per = $line_ttar[$a];
                        $model_new_target->ptar_per = $line_ptar[$a];
                        if($model_new_target->save(false)){
                            if($target_personal_data!=null){
                                for($z=0;$z<=count($target_personal_data)-1;$z++){
                                    $model_new_personal = new \common\models\TeamPersonalTarget();
                                    $model_new_personal->target_year_id = $model_check_target_year->id;
                                    $model_new_personal->team_target_id = $model_new_target->id;
                                    $model_new_personal->emp_id = $target_personal_data[$z]['emp_id'][0];
                                    $model_new_personal->emp_target_amount = str_replace(",","",$target_personal_data[$z]['target'][$a]);
                                    $model_new_personal->save(false);
                                }
                            }
                        }
                    }
                }
            }else{
                $model_new = new \common\models\TeamTargetYear();
                $model_new->target_year = $perform_year;
                $model_new->team_id = $team_id;
                $model_new->target_amount = 0;
                if($model_new->save(false)){
                    if($line_milestone!=null){
                        for($a=0;$a<=count($line_milestone)-1;$a++){
                            $model_new_target = new \common\models\TeamTarget();
                            $model_new_target->target_year_id = $model_new->id;
                            $model_new_target->milestone = $line_milestone[$a];
                            $model_new_target->monthly_amount = str_replace(",","",$line_monthly_target[$a]);
                            $model_new_target->tele_sell_amount = str_replace(",","",$line_tele_sell_target[$a]);
                            $model_new_target->installation_amount = str_replace(",","",$line_install_target[$a]);
                            $model_new_target->ttar_per = $line_ttar[$a];
                            $model_new_target->ptar_per = $line_ptar[$a];
                            if($model_new_target->save(false)){
                                if($target_personal_data!=null){
                                    \common\models\TeamPersonalTarget::deleteAll(['team_target_id'=>$model_new_target->id]);
                                    for($z=0;$z<=count($target_personal_data)-1;$z++){
                                        $model_new_personal = new \common\models\TeamPersonalTarget();
                                        $model_new_personal->target_year_id = $model_new->id;
                                        $model_new_personal->team_target_id = $model_new_target->id;
                                        $model_new_personal->emp_id = $target_personal_data[$z]['emp_id'][0];
                                        $model_new_personal->emp_target_amount = str_replace(",","",$target_personal_data[$z]['target'][0]);
                                        $model_new_personal->save(false);
                                    }
                                }
                            }
                        }
                    }
                }
            }

        }



        if($perform_year && $perform_month && $team_id){
            if($line_emp_id!=null){
                \common\models\PerformanceChart::deleteAll(['perform_year' => $perform_year, 'perform_month' => $perform_month, 'team_id' => $team_id]);
                for($x=0;$x<=count($line_emp_id)-1;$x++){
                    $model_new = new \common\models\PerformanceChart();
                    $model_new->perform_year = $perform_year;
                    $model_new->perform_month = $perform_month;
                    $model_new->team_id = $team_id;
                    $model_new->emp_id = $line_emp_id[$x];
                    $model_new->sale_amount_month = $line_sale_value_amount[$x];
                    $model_new->sale_per_month = $line_sale_per_amount[$x];
                    $model_new->profit_amount = $line_profit_amount[$x];
                    $model_new->profit_per = $line_profit_per[$x];
                    $model_new->job_quantity = $line_job_count[$x];
                    $model_new->job_quantity_per = $line_job_count_per[$x];
                    $model_new->time_atten_per = $line_attendance[$x];
                    $model_new->personal_perform_per = $line_personal_perform[$x];
                    $model_new->hight_perform_per = $line_job_high_per[$x];
                    $model_new->low_perform_per = $line_job_low_per[$x];
                    $model_new->save(false);
                }
            }
        }


        if ($perform_year && $perform_month && $team_id) {

            if ($line_kpi_title_id != null) {
                \common\models\KpiPerformance::deleteAll(['perform_year' => $perform_year, 'perform_month' => $perform_month, 'team_id' => $team_id]);
                for ($i = 0; $i <= count($line_kpi_title_id) - 1; $i++) {
                    $model = new \common\models\KpiPerformance();
                    $model->trans_date = date('Y-m-d H:i:s');
                    $model->team_id = $team_id;
                    $model->kpi_title_id = $line_kpi_title_id[$i];
                    $model->rating_per = $line_kpi_rating[$i];
                    $model->personal_goal_per = $line_kpi_personal_goal[$i];
                    $model->high_performance_per = $line_kpi_high_performance[$i];
                    $model->minimum_per = $line_kpi_minimum[$i];
                    $model->low_performance_per = $line_kpi_low_performance[$i];
                    $model->perform_year = $perform_year;
                    $model->perform_month = $perform_month;
                    $model->save(false);
                }

                \common\models\PerformanceChart::updateAll(['hight_perform_per'=>$line_kpi_high_total,'low_perform_per'=>$line_kpi_low_total],['team_id'=>$team_id,'perform_year'=>$perform_year,'perform_month'=>$perform_month]);
            }

            // }
        }

        return $this->redirect(['index']);
    }
}
