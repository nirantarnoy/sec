<?php
namespace backend\controllers;

use backend\models\Job;
use backend\models\JobSearch;
use yii\web\NotFoundHttpException;

class WaitapprovepayController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new JobSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
        $dataProvider->query->andFilterWhere(['status' => 3]);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }
    public function actionView($id)
    {
        $model_line = \common\models\JobLine::find()->where(['job_id' => $id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'model_line' => $model_line,
        ]);
    }
    protected function findModel($id)
    {
        if (($model = Job::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionApprovepayment(){
        $id = \Yii::$app->request->post('job_id');
        $model = $this->findModel($id);
        $model->status = 4;
        $model->save(false);
        \Yii::$app->session->setFlash('msg-success', 'Approve Payment ใบงานเรียบร้อยแล้ว.');
        return $this->redirect(['waitapprovepay/index']);
    }
}