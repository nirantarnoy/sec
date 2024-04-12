<?php

namespace backend\controllers;

use backend\models\Company;
use backend\models\CompanySearch;
use common\models\CompanyDoc;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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
     * Lists all Company models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");

        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Company model.
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
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Company();

        if ($this->request->isPost) {

            if ($model->load($this->request->post())) {

                $line_doc_name = \Yii::$app->request->post('line_doc_name');
                // $line_file_name = \Yii::$app->request->post('line_file_name');
                $uploaded = UploadedFile::getInstancesByName('line_file_name');

                $model->social_base_price = $model->social_base_price == null ? 0 : $model->social_base_price;
                if ($model->save()) {
                    if ($line_doc_name != null) {
                        for ($i = 0; $i <= count($line_doc_name) - 1; $i++) {

                            foreach ($uploaded as $key => $value) {
                                if ($key == $i) {
                                    if (!empty($value)) {
                                        $upfiles = time() . "." . $value->getExtension();
                                        // if ($uploaded->saveAs(Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles)) {
                                        if ($value->saveAs('../web/uploads/company_doc/' . $upfiles)) {
                                            $model_doc = new \common\models\CompanyDoc();
                                            $model_doc->company_id = $model->id;
                                            $model_doc->doc_name = $upfiles;
                                            $model_doc->description = $line_doc_name[$i];
                                            $model_doc->save(false);
                                        }
                                    }
                                }
                            }


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
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line_doc = \common\models\CompanyDoc::find()->where(['company_id' => $id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
//            $uploaded = UploadedFile::getInstance($model, 'doc');
            $removelist = \Yii::$app->request->post('remove_list');
            $line_doc_name = \Yii::$app->request->post('line_doc_name');
            // $line_file_name = \Yii::$app->request->post('line_file_name');
            $uploaded = UploadedFile::getInstancesByName('line_file_name');
             $line_id = \Yii::$app->request->post('rec_id');


             $update_social_date = date('Y-m-d H:i:s');
             // print_r($line_id);return;
            $model->social_base_price = $model->social_base_price == null ? 0 : $model->social_base_price;
            if ($model->save()) {
                if ($line_id != null) {
                    // echo count($uploaded);return;
                    for ($i = 0; $i <= count($line_id) - 1; $i++) {
                        $model_check = \common\models\CompanyDoc::find()->where(['id' => $line_id[$i]])->one();
                        if ($model_check) {
                            $model_check->description = $line_doc_name[$i];
                            $model_check->save(false);
                        } else {
                            foreach ($uploaded as $key => $value) {

                                if (!empty($value)) {
                                    $upfiles = time() + 2 . "." . $value->getExtension();
                                    // if ($uploaded->saveAs(Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles)) {
                                    if ($value->saveAs('../web/uploads/company_doc/' . $upfiles)) {
                                        $model_doc = new \common\models\CompanyDoc();
                                        $model_doc->company_id = $model->id;
                                        $model_doc->doc_name = $upfiles;
                                        $model_doc->description = $line_doc_name[$i];
                                        $model_doc->save(false);
                                    }
                                }
                            }
                        }
                    }
                }

                $delete_rec = explode(",", $removelist);
                if (count($delete_rec)) {
                    $model_find_doc_delete = \common\models\CompanyDoc::find()->where(['id' => $delete_rec])->one();
                    if ($model_find_doc_delete) {
                        if (file_exists(\Yii::getAlias('@backend') . '/web/uploads/company_doc/' . $model_find_doc_delete->doc_name)) {
                            if (unlink(\Yii::getAlias('@backend') . '/web/uploads/company_doc/' . $model_find_doc_delete->doc_name)) {
                                \common\models\CompanyDoc::deleteAll(['id' => $delete_rec]);
                            }
                        }
                    }

                }

                // update social per rate

                $model_social_per = \common\models\SocialPerTrans::find()->where(['company_id'=>$id,'month(trans_date)'=>date('m'),'year(trans_date)'=>date('Y')])->one();
                if($model_social_per){
                    $model_social_per->trans_date = date('Y-m-d H:i:s');
                    $model_social_per->social_per = $model->social_deduct_per;
                    $model_social_per->save(false);
                }else{
                    $model_new_social_per = new \common\models\SocialPerTrans();
                    $model_new_social_per->company_id = $id;
                    $model_new_social_per->trans_date = $update_social_date;
                    $model_new_social_per->social_per = $model->social_deduct_per;
                    $model_new_social_per->save(false);
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'model_line_doc' => $model_line_doc,
        ]);
    }

    /**
     * Deletes an existing Company model.
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
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionRemovedoc()
    {
        $company_id = \Yii::$app->request->post('company_id');
        $doc_name = \Yii::$app->request->post('doc_name');

        echo $company_id . ' = ' . $doc_name;

        if ($company_id && $doc_name != '') {
            if (file_exists(\Yii::getAlias('@backend') . '/web/uploads/company_doc/' . $doc_name)) {
                if (unlink(\Yii::getAlias('@backend') . '/web/uploads/company_doc/' . $doc_name)) {
                    $model = \backend\models\Company::find()->where(['id' => $company_id])->one();
                    if ($model) {
                        $model->doc = '';
                        $model->save(false);
                    }
                }
            }
        } else {
            echo "no";
            return;
        }
        return $this->redirect(['company/update', 'id' => $company_id]);
    }
}
