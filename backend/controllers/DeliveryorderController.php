<?php

namespace backend\controllers;

use backend\models\Deliveryorder;
use backend\models\DeliveryorderSearch;
use backend\models\PositionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DeliveryorderController implements the CRUD actions for Deliveryorder model.
 */
class DeliveryorderController extends Controller
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
     * Lists all Deliveryorder models.
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
        $searchModel = new DeliveryorderSearch();
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
     * Displays a single Deliveryorder model.
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
     * Creates a new Deliveryorder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Deliveryorder();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
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
     * Updates an existing Deliveryorder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model_line = \common\models\DeliveryOrderLine::find()->where(['delivery_order_id' => $id])->all();

        $model_cal_line = \common\models\DeliveryOrderCal::find()->where(['delivery_order_id' => $id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $line_rec_id = \Yii::$app->request->post('line_rec_id');
            $line_name = \Yii::$app->request->post('line_product_name');
            $line_qty = \Yii::$app->request->post('line_qty');
            $line_description = \Yii::$app->request->post('line_product_name_description');

            if ($model->save(false)) {
                if ($line_rec_id != null) {
                    for ($i = 0; $i < count($line_rec_id); $i++) {
                        \common\models\DeliveryOrderLine::updateAll(['name' => $line_name[$i], 'description' => $line_description[$i], 'qty' => $line_qty[$i]], ['id' => $line_rec_id[$i]]);
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line,
            'model_cal_line' => $model_cal_line,
        ]);
    }

    /**
     * Deletes an existing Deliveryorder model.
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
     * Finds the Deliveryorder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Deliveryorder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Deliveryorder::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPrint($id)
    {
        //if($id != null){
        $model = \backend\models\Order::find()->where(['id' => $id])->one();
        $model_line = \common\models\OrderLine::find()->where(['order_id' => $id])->all();
        return $this->render('_print', [
            'model' => $model,
            'model_line' => $model_line
        ]);
        //}
    }

    public function actionPrintdo($id)
    {
        //if($id != null){
        $model = \backend\models\Deliveryorder::find()->where(['id' => $id])->one();
        $model_line = \common\models\DeliveryOrderLine::find()->where(['delivery_order_id' => $id])->all();
        return $this->render('_printdo', [
            'model' => $model,
            'model_line' => $model_line
        ]);
        //}
    }

    public function actionPrintreciept($id)
    {
        //if($id != null){
        $model = \backend\models\Order::find()->where(['id' => $id])->one();
        $model_line = \common\models\OrderLine::find()->where(['order_id' => $id])->all();
        return $this->render('_printreciept', [
            'model' => $model,
            'model_line' => $model_line
        ]);
        //}
    }

    public function actionPrinttaxinvoice($id)
    {
        //if($id != null){
        $model = \backend\models\Order::find()->where(['id' => $id])->one();
        $model_line = \common\models\OrderLine::find()->where(['order_id' => $id])->all();
        return $this->render('_printtaxinvoice', [
            'model' => $model,
            'model_line' => $model_line
        ]);
        //}
    }

    public function actionFindstock()
    {
        $do_id = \Yii::$app->request->post('do_id');
        // $customer_id =  \Yii::$app->request->post('customer_id');
        $html = '';
        if ($do_id > 0) {
            $model_do = \common\models\DeliveryOrderLine::find()->select(['product_id'])->where(['delivery_order_id' => $do_id])->all();
            if($model_do){
                foreach ($model_do as $value) {
                    $model = \backend\models\Stocksum::find()->select(['id', 'product_id', 'expired_date', 'qty'])->where(['product_id' => $value->product_id])->orderBy(['expired_date' => SORT_ASC])->all();
                    if ($model) {
                        foreach ($model as $x_value) {

                            $html .= '<tr>';
                            $html .= '<td style="text-align: center">
                            <div class="btn btn-outline-success btn-sm" onclick="addselecteditem($(this))" data-var="' . $x_value->id . '">เลือก</div>
                         
                            <input type="hidden" class="line-find-product-id" value="' . $x_value->product_id . '">
                            <input type="hidden" class="line-find-qty" value="' . $x_value->qty . '">
                            <input type="hidden" class="line-find-product-name" value="' . \backend\models\Product::findName($x_value->product_id) . '">
                           </td>';
                            $html .= '<td style="text-align: center">' . date('d-m-Y', strtotime($x_value->expired_date)) . '</td>';
                            $html .= '<td style="text-align: center">' . \backend\models\Product::findSku($x_value->product_id) . '</td>';
                            $html .= '<td style="text-align: left">' . \backend\models\Product::findName($x_value->product_id) . '</td>';
                            $html .= '<td style="text-align: right">' . number_format($x_value->qty, 1) . '</td>';
                            $html .= '</tr>';
                        }
                    }
                }
            }

        }
        echo $html;
    }
}
