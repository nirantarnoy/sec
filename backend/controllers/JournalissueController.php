<?php

namespace backend\controllers;

use backend\models\Journalissue;
use backend\models\JournalissueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JournalissueController implements the CRUD actions for Journalissue model.
 */
class JournalissueController extends Controller
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
     * Lists all Journalissue models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new JournalissueSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);


        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
            'viewstatus' => '',
        ]);
    }

    /**
     * Displays a single Journalissue model.
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
     * Creates a new Journalissue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Journalissue();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $line_item_id = \Yii::$app->request->post('line_product_id');
                $line_warehouse_id = \Yii::$app->request->post('line_product_warehouse_id');
                $line_qty = \Yii::$app->request->post('line_qty');
                $line_remark = \Yii::$app->request->post('line_remark');
                $xdate = explode('-', $model->trans_date);
                $t_date = date('Y-m-d');
                if (count($xdate) > 1) {
                    $t_date = $xdate[2] . '-' . $xdate[1] . '-' . $xdate[0];
                }

                $model->journal_no = Journalissue::getLastNo();
                $model->trans_date = date('Y-m-d', strtotime($t_date));
                if ($model->save(false)) {
                    if ($line_item_id != null) {
                        for ($i = 0; $i <= count($line_item_id) - 1; $i++) {
                            $model_line = new \common\models\JournalIssueLine();
                            $model_line->journal_issue_id = $model->id;
                            $model_line->product_id = $line_item_id[$i];
                            $model_line->qry = $line_qty[$i];
                            $model_line->status = 0;
                            $model_line->warehouse_id = $line_warehouse_id[$i];
                            $model_line->reason = $line_remark[$i];
                            if ($model_line->save(false)) {
                                $model_trans = new \backend\models\Stocktrans();
                                $model_trans->journal_no = $model->journal_no;
                                $model_trans->trans_date = date('Y-m-d H:i:s');
                                $model_trans->item_id = $line_item_id[$i];
                                $model_trans->qty = (float)$line_qty[$i];
                                $model_trans->activity_type_id = 3; // 3 is issue
                                $model_trans->stock_type_id = 2; // 1 = in , 2 = out
                                $model_trans->warehouse_id = $line_warehouse_id[$i];
                                $model_trans->trans_ref_id = $model->id;
                                if ($model_trans->save(false)) {
                                    $model_stock = \backend\models\Stocksum::find()->where(['item_id' => $line_item_id[$i], 'warehouse_id' => $line_warehouse_id[$i]])->one();
                                    if ($model_stock) {
                                        $model_stock->qty = (float)$model_stock->qty - (float)$line_qty[$i];
                                        $model_stock->last_update = date('Y-m-d H:i:s');
                                        $model_stock->save(false);
                                    } else {
//                                        $model_new = new \backend\models\Stocksum();
//                                        $model_new->company_id = 1;
//                                        $model_new->item_id = $line_item_id[$i];
//                                        $model_new->warehouse_id = $line_warehouse_id[$i];
//                                        $model_new->qty = (float)$line_qty[$i];
//                                        $model_new->last_update = date('Y-m-d H:i:s');
//                                        $model_new->save(false);

                                    }
                                }
                            }
                        }
                    }

                    if ($model->trans_ref_id > 0) {
                        \common\models\Workorder::updateAll(['is_issue_status' => 1], ['id' => $model->trans_ref_id]);
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
     * Updates an existing Journalissue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line = \common\models\JournalIssueLine::find()->where(['journal_issue_id' => $id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $line_item_id = \Yii::$app->request->post('line_product_id');
            $line_warehouse_id = \Yii::$app->request->post('line_warehouse_id');
            $line_qty = \Yii::$app->request->post('line_qty');
            $removelist = \Yii::$app->request->post('removelist');

            //print_r($line_item_id);return;

            $xdate = explode('-', $model->trans_date);
            $t_date = date('Y-m-d');
            if (count($xdate) > 1) {
                $t_date = $xdate[2] . '-' . $xdate[1] . '-' . $xdate[0];
            }
            $model->trans_date = date('Y-m-d', strtotime($t_date));

            if ($model->save(false)) {
//                if ($line_item_id != null) {
//                    for ($i = 0; $i <= count($line_item_id) - 1; $i++) {
//                        $model_check = \common\models\JournalIssueLine::find()->where(['journal_issue_id' => $model->id, 'product_id' => $line_item_id[$i]])->one();
//                        if ($model_check) {
//                            $model_check->product_id = $line_item_id[$i];
//                            $model_check->qry = $line_qty[$i];
//                            $model_check->status = 0;
//                            $model_check->warehouse_id = $line_warehouse_id[$i];
//                            $model_check->save(false);
//                        } else {
//                            $model_line = new \common\models\JournalIssueLine();
//                            $model_line->journal_issue_id = $model->id;
//                            $model_line->product_id = $line_item_id[$i];
//                            $model_line->qry = $line_qty[$i];
//                            $model_line->status = 0;
//                            $model_line->warehouse_id = $line_warehouse_id[$i];
//                            $model_line->save(false);
//                        }
//
//                    }
//                }

                if ($removelist != null) {
                    $x = explode(',', $removelist);
                    if ($x != null) {
                        for ($m = 0; $m <= count($x) - 1; $m++) {
                            $model_return = \common\models\JournalIssueLine::find()->where(['id' => $x[$m]])->one();
                            if ($model_return) {
                                $model_trans = new \backend\models\Stocktrans();
                                $model_trans->journal_no = \backend\models\Journalissue::getReturnLastNo();
                                $model_trans->trans_date = date('Y-m-d H:i:s');
                                $model_trans->item_id = $model_return->product_id;
                                $model_trans->qty = (float)$model_return->qry;
                                $model_trans->activity_type_id = 4; // 4 is return issue
                                $model_trans->stock_type_id = 1; // 1 = in , 2 = out
                                $model_trans->trans_ref_id = $model->id;
                                if ($model_trans->save(false)) {
                                    $model_stock = \backend\models\Stocksum::find()->where(['item_id' => $model_return->product_id, 'warehouse_id' => $line_warehouse_id[$m]])->one();
                                    if ($model_stock) {
                                        $model_stock->qty = (float)$model_stock->qty + (float)$model_return->qry;
                                        $model_stock->last_update = date('Y-m-d H:i:s');
                                        $model_stock->save(false);
                                    } else {
//                                        $model_new = new \backend\models\Stocksum();
//                                        $model_new->company_id = 1;
//                                        $model_new->item_id = $model_return->product_id;
//                                        $model_new->warehouse_id = $line_warehouse_id[$m];
//                                        $model_new->qty = (float)$model_return->qry;
//                                        $model_new->last_update = date('Y-m-d H:i:s');
//                                        $model_new->save(false);

                                    }
                                }
                                $model_return->status = 3; // 3 is cancel
                                $model_return->save(false);
                            }
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
     * Deletes an existing Journalissue model.
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
     * Finds the Journalissue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Journalissue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Journalissue::findOne(['id' => $id])) !== null) {
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
        $model = \backend\models\Stocksum::find()->all();
        if ($model) {
            $has_data = 1;
            foreach ($model as $value) {
                $onhand_qty = $value->qty;
                $code = \backend\models\Product::findCode($value->item_id);
                $name = \backend\models\Product::findName($value->item_id);
                $warehouse_name = \backend\models\Warehouse::findName($value->warehouse_id);
                $html .= '<tr>';
                $html .= '<td style="text-align: center">
                            <div class="btn btn-outline-success btn-sm" onclick="addselecteditem($(this))" data-var="' . $value->item_id . '">เลือก</div>
                            <input type="hidden" class="line-find-item-id" value="' . $value->item_id . '">
                            <input type="hidden" class="line-find-item-code" value="' . $code . '">
                            <input type="hidden" class="line-find-item-name" value="' . $name . '">
                           <input type="hidden" class="line-find-onhand-qty" value="' . $onhand_qty . '">
                           <input type="hidden" class="line-find-warehouse-id" value="' . $value->warehouse_id . '">
                           <input type="hidden" class="line-find-warehouse-name" value="' . $warehouse_name . '">
                           </td>';
                $html .= '<td style="text-align: left">' . $code . '</td>';
                $html .= '<td style="text-align: left">' . $name . '</td>';
                $html .= '<td style="text-align: left">' . $warehouse_name . '</td>';
                $html .= '<td style="text-align: left">' . $onhand_qty . '</td>';
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
