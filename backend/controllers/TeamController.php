<?php

namespace backend\controllers;

use backend\models\Team;
use backend\models\TeamSearch;
use backend\models\UnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeamController implements the CRUD actions for Team model.
 */
class TeamController extends Controller
{
    public $enableCsrfValidation =false;
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
     * Lists all Team models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new TeamSearch();
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
     * Displays a single Team model.
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
     * Creates a new Team model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Team();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $line_emp_id = \Yii::$app->request->post('line_emp_id');
                $line_emp_name = \Yii::$app->request->post('line_emp_name');
                $line_is_head = \Yii::$app->request->post('line_is_head');

                if($model->save(false)){
                    if(!empty($line_emp_id)){
                        for($i = 0; $i <= count($line_emp_id)-1; $i++){
                            $model_line = new \common\models\TeamLine();
                            $model_line->team_id = $model->id;
                            $model_line->emp_id = $line_emp_id[$i];
                            $model_line->is_head = $line_is_head[$i];
                            $model_line->status = 0;
                            $model_line->save();
                        }
                    }
                   // return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing Team model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line = \common\models\TeamLine::find()->where(['team_id' => $id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $line_emp_id = \Yii::$app->request->post('line_emp_id');
            $line_emp_name = \Yii::$app->request->post('line_emp_name');
            $line_is_head = \Yii::$app->request->post('line_is_head');
            $removelist = \Yii::$app->request->post('removelist');
            if($model->save(false)){
                if(!empty($line_emp_id)){
                    \common\models\TeamLine::deleteAll(['team_id' => $id]);
                    for($i = 0; $i <= count($line_emp_id)-1; $i++){
                        $model_line = new \common\models\TeamLine();
                        $model_line->team_id = $model->id;
                        $model_line->emp_id = $line_emp_id[$i];
                        $model_line->is_head = $line_is_head[$i];
                        $model_line->status = 0;
                        $model_line->save();
                    }
                }
                if($removelist != null || $removelist != ''){
                    $ex = explode(',', $removelist);
                    if($ex != null){
                       \common\models\TeamLine::deleteAll(['team_id' => $ex]);
                    }
                }
            }
            //return $this->redirect(['view', 'id' => $model->id]);
            \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'บันทึกข้อมูลเรียบร้อยแล้ว'));
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line,
        ]);
    }

    /**
     * Deletes an existing Team model.
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
     * Finds the Team model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Team the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Team::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFinditem()
    {
        $html = '';
        $has_data = 0;
        //$model = \backend\models\Workqueue::find()->where(['is_invoice' => 0])->all();
        // $model = \backend\models\Stocksum::find()->where(['warehouse_id' => 7])->all();
        $model = \backend\models\Employee::find()->where(['status'=>1])->orderBy(['id'=>SORT_ASC])->all();
        if ($model) {
            $has_data = 1;
            foreach ($model as $value) {
                $name = $value->f_name.' '.$value->l_name;
                $html .= '<tr>';
                $html .= '<td style="text-align: center">
                            <div class="btn btn-outline-success btn-sm" onclick="addselecteditem($(this))" data-var="' . $value->id . '">เลือก</div>
                            <input type="hidden" class="line-find-emp-id" value="' . $value->id . '">
                            <input type="hidden" class="line-find-emp-name" value="' . $name . '">
                           </td>';
                $html .= '<td style="text-align: left">' . $value->code  . '</td>';
                $html .= '<td style="text-align: left">' . $name . '</td>';
                $html .= '</tr>';
            }
        }

        if ($has_data == 0) {
            $html .= '<tr>';
            $html .= '<td colspan="5" style="text-align: center;color: red;">ไม่พบข้อมูล</td>';
            $html .= '</tr>';
        }
        echo $html;
    }
}
