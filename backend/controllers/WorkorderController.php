<?php

namespace backend\controllers;

use backend\models\Journalissue;
use backend\models\WarehouseSearch;
use backend\models\Workorder;
use backend\models\WorkorderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkorderController implements the CRUD actions for Workorder model.
 */
class WorkorderController extends Controller
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
     * Lists all Workorder models.
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
        $searchModel = new WorkorderSearch();
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
     * Displays a single Workorder model.
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
     * Creates a new Workorder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Workorder();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $line_text = \Yii::$app->request->post('line_text');

                $xdate = explode('-', $model->trans_date);
                $t_date = date('Y-m-d');
                if (count($xdate) > 1) {
                    $t_date = $xdate[2] . '-' . $xdate[1] . '-' . $xdate[0];
                }

                $model->workorder_no = Workorder::getLastNo();
                $model->trans_date = date('Y-m-d', strtotime($t_date));
                $model->is_issue_status = 0;
                if ($model->save(false)) {
                    if ($line_text != null) {
                        for ($i = 0; $i <= count($line_text) - 1; $i++) {
                            if($line_text[$i]=='')continue;
                            $model_line = new \common\models\WorkorderLine();
                            $model_line->workorder_id = $model->id;
                            $model_line->description = $line_text[$i];
                            $model_line->save(false);
                        }
                    }
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
     * Updates an existing Workorder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line = \common\models\WorkorderLine::find()->where(['workorder_id'=>$id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $line_text = \Yii::$app->request->post('line_text');
            $removelist = \Yii::$app->request->post('removelist');

            $xdate = explode('-', $model->trans_date);
            $t_date = date('Y-m-d');
            if (count($xdate) > 1) {
                $t_date = $xdate[2] . '-' . $xdate[1] . '-' . $xdate[0];
            }

            $model->trans_date = date('Y-m-d', strtotime($t_date));
            if ($model->save(false)) {
                if ($line_text != null) {
                    \common\models\WorkorderLine::deleteAll(['workorder_id'=>$id]);
                    for ($i = 0; $i <= count($line_text) - 1; $i++) {
                        if($line_text[$i]=='')continue;
                        $model_line = new \common\models\WorkorderLine();
                        $model_line->workorder_id = $model->id;
                        $model_line->description = $line_text[$i];
                        $model_line->save(false);
                    }
                }

                if ($removelist != null) {
                    $x = explode(',', $removelist);
                    if ($x != null) {
                        for ($m = 0; $m <= count($x) - 1; $m++) {
                            \common\models\PurchLine::deleteAll(['id' => $x[$m]]);
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line,
        ]);
    }

    /**
     * Deletes an existing Workorder model.
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
     * Finds the Workorder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Workorder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Workorder::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
