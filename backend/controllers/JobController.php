<?php

namespace backend\controllers;

use backend\models\Job;
use backend\models\Jobdeduct;
use backend\models\JobSearch;
use backend\models\TeamSearch;
use common\models\JobPayment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * JobController implements the CRUD actions for Job model.
 */
class JobController extends Controller
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
     * Lists all Job models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new JobSearch();
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
     * Displays a single Job model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model_line = \common\models\JobLine::find()->where(['job_id' => $id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'model_line' => $model_line,
        ]);
    }

    /**
     * Creates a new Job model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Job();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $line_product_id = \Yii::$app->request->post('line_product_id');
                $line_product_name = \Yii::$app->request->post('line_product_name');
                $line_cost_per_unit = \Yii::$app->request->post('line_cost_per_unit');
                $line_discount = \Yii::$app->request->post('line_discount');
                $line_dealer_price = \Yii::$app->request->post('line_dealer_price');
                $line_vat = \Yii::$app->request->post('line_vat');
                $line_total_cost_per_unit = \Yii::$app->request->post('line_total_cost_per_unit');
                $line_qty = \Yii::$app->request->post('line_qty');
                $line_total_cost_all = \Yii::$app->request->post('line_total_cost_all');
                $line_quote_per_unit = \Yii::$app->request->post('line_quote_per_unit');
                $line_total_quote_price = \Yii::$app->request->post('line_total_quote_price');

                $model->job_no = $model::getLastNo();
                $trans_date = date('Y-m-d H:is');
                $xdate = explode('-', $model->trans_date);
                if ($xdate != null) {
                    if (count($xdate) > 1) {
                        $trans_date = $xdate[2] . '/' . $xdate[1] . '/' . $xdate[0];
                    }
                }

                $model->trans_date = date('Y-m-d', strtotime($trans_date));
                $model->status = 1; // open
                if ($model->save()) {
                    if ($line_product_id != null) {
                        if (count($line_product_id) > 0) {
                            for ($i = 0; $i <= count($line_product_id) - 1; $i++) {
                                $model_line = new \common\models\JobLine();
                                $model_line->job_id = $model->id;
                                $model_line->product_id = $line_product_id[$i];
                                $model_line->product_name = $line_product_name[$i];
                                $model_line->cost_per_unit = $line_cost_per_unit[$i];
                                $model_line->discount_per = $line_discount[$i];
                                $model_line->dealer_price = $line_dealer_price[$i];
                                $model_line->vat_amount = $line_vat[$i];
                                $model_line->total_cost_per_unit = $line_total_cost_per_unit[$i];
                                $model_line->qty = $line_qty[$i];
                                $model_line->cost_total = $line_total_cost_all[$i];
                                $model_line->quotation_per_unit_price = $line_quote_per_unit[$i];
                                $model_line->total_quotation_price = $line_total_quote_price[$i];
                                $model_line->save(false);
                            }
                        }
                    }
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
     * Updates an existing Job model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line = \common\models\JobLine::find()->where(['job_id' => $id])->all();

        if ($model->load($this->request->post())) {

            $line_product_id = \Yii::$app->request->post('line_product_id');
            $line_product_name = \Yii::$app->request->post('line_product_name');
            $line_cost_per_unit = \Yii::$app->request->post('line_cost_per_unit');
            $line_discount = \Yii::$app->request->post('line_discount');
            $line_dealer_price = \Yii::$app->request->post('line_dealer_price');
            $line_vat = \Yii::$app->request->post('line_vat');
            $line_total_cost_per_unit = \Yii::$app->request->post('line_total_cost_per_unit');
            $line_qty = \Yii::$app->request->post('line_qty');
            $line_total_cost_all = \Yii::$app->request->post('line_total_cost_all');
            $line_quote_per_unit = \Yii::$app->request->post('line_quote_per_unit');
            $line_total_quote_price = \Yii::$app->request->post('line_total_quote_price');

            $removelist = \Yii::$app->request->post('removelist');
            $rec_id = \Yii::$app->request->post('rec_id');

            //print_r($rec_id);return ;

            $trans_date = date('Y-m-d H:is');
            $xdate = explode('-', $model->trans_date);
            if ($xdate != null) {
                if (count($xdate) > 1) {
                    $trans_date = $xdate[2] . '/' . $xdate[1] . '/' . $xdate[0];
                }
            }

            $model->trans_date = date('Y-m-d', strtotime($trans_date));


            if ($model->save(false)) {
                if ($line_product_id != null) {
                    if (count($line_product_id) > 0) {
                        for ($i = 0; $i <= count($line_product_id) - 1; $i++) {

                            $check_has = \common\models\JobLine::find()->where(['job_id' => $model->id, 'id' => $rec_id[$i]])->one();
                            if ($check_has != null) {
                                $check_has->product_id = $line_product_id[$i];
                                $check_has->product_name = $line_product_name[$i];
                                $check_has->cost_per_unit = $line_cost_per_unit[$i];
                                $check_has->discount_per = $line_discount[$i];
                                $check_has->dealer_price = $line_dealer_price[$i];
                                $check_has->vat_amount = $line_vat[$i];
                                $check_has->total_cost_per_unit = $line_total_cost_per_unit[$i];
                                $check_has->qty = $line_qty[$i];
                                $check_has->cost_total = $line_total_cost_all[$i];
                                $check_has->quotation_per_unit_price = $line_quote_per_unit[$i];
                                $check_has->total_quotation_price = $line_total_quote_price[$i];
                                $check_has->save(false);
                            } else {
                                $model_line = new \common\models\JobLine();
                                $model_line->job_id = $model->id;
                                $model_line->product_id = $line_product_id[$i];
                                $model_line->product_name = $line_product_name[$i];
                                $model_line->cost_per_unit = $line_cost_per_unit[$i];
                                $model_line->discount_per = $line_discount[$i];
                                $model_line->dealer_price = $line_dealer_price[$i];
                                $model_line->vat_amount = $line_vat[$i];
                                $model_line->total_cost_per_unit = $line_total_cost_per_unit[$i];
                                $model_line->qty = $line_qty[$i];
                                $model_line->cost_total = $line_total_cost_all[$i];
                                $model_line->quotation_per_unit_price = $line_quote_per_unit[$i];
                                $model_line->total_quotation_price = $line_total_quote_price[$i];
                                $model_line->save(false);
                            }
                        }
                    }

                    if ($removelist != null || $removelist != '') {
                        $xp = explode(',', $removelist);
                        if (count($xp) > 0) {
                            for ($x = 0; $x <= count($xp) - 1; $x++) {
                                \common\models\JobLine::deleteAll(['id' => $xp[$x]]);
                            }
                        }
                    }
                }
                \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'บันทึกข้อมูลเรียบร้อยแล้ว'));
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line,
        ]);
    }

    /**
     * Deletes an existing Job model.
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

    public function actionCreatededuct()
    {
        $job_id = \Yii::$app->request->post('job_id');
        $deduct_title_id = \Yii::$app->request->post('line_deduct_title_id');
        $deduct_amount = \Yii::$app->request->post('line_deduct_amount');
        $deduct_remark = \Yii::$app->request->post('line_deduct_remark');
        $line_is_vat = \Yii::$app->request->post('line_is_vat');

        $deduct_remove_list = \Yii::$app->request->post('deduct_remove_list');

        if ($job_id) {
            if ($deduct_title_id != null) {
                for ($i = 0; $i <= count($deduct_title_id) - 1; $i++) {
                    $check = Jobdeduct::find()->where(['job_id' => $job_id, 'deduct_title_id' => $deduct_title_id[$i]])->one();
                    if ($check != null) {
                        $check->amount = $deduct_amount[$i];
                        $check->note = $deduct_remark[$i];
                        $check->is_vat = $line_is_vat[$i];
                        $check->save(false);
                    } else {
                        $model = new Jobdeduct();
                        $model->job_id = $job_id;
                        $model->trans_date = date('Y-m-d H:i:s');
                        $model->deduct_title_id = $deduct_title_id[$i];
                        $model->amount = $deduct_amount[$i];
                        $model->note = $deduct_remark[$i];
                        $model->is_vat = $line_is_vat[$i];
                        $model->save(false);
                    }
                }
            }

            if($deduct_remove_list != null || $deduct_remove_list != ''){
                $xp = explode(',', $deduct_remove_list);
                if (count($xp) > 0) {
                    for ($x = 0; $x <= count($xp) - 1; $x++) {
                        \common\models\Jobdeduct::deleteAll(['id' => $xp[$x]]);
                    }
                }
            }
        }
        $model_line = \common\models\JobLine::find()->where(['job_id' => $job_id])->all();
        return $this->render('view', [
            'model' => $this->findModel($job_id),
            'model_line' => $model_line,
        ]);

    }

    /**
     * Finds the Job model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Job the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Job::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionShowDeduct()
    {
        $html = '';
        $job_id = \Yii::$app->request->post('id');
        $model = new Jobdeduct();
        $model_old = Jobdeduct::find()->where(['job_id' => $job_id])->all();
        if ($model_old != null) {
            foreach ($model_old as $key => $value) {
                $deduct_name = \backend\models\Deductitem::findName($value->deduct_title_id);
                $is_vat = $value->is_vat == 1 ? 'YES' : 'NO';
                $html .= '
                <tr data-var="'.$value->id.'">
                            <td style="text-align: center;">
                            <input type="text" style="text-align: center;" class="form-control line-num" value="' . ($key + 1) . '" readonly></td>
                            <td>
                                <input type="hidden" class="line-deduct-title-id" name="line_deduct_title_id[]" value="' . $value->deduct_title_id . '">
                                <input type="text" class="form-control line-deduct-title-name"
                                       name="line_deduct_title_name[]" value="' . $deduct_name . '">
                            </td>
                            <td>   
                                <input type="number" style="text-align: right" class="form-control line-deduct-amount" name="line_deduct_amount[]"
                                       value="' . $value->amount . '" onchange="caltotaldeduct();" min="0">
                            </td>
                            <td>
                            <input type="hidden" style="text-align: right" class="form-control line-is-vat" name="line_is_vat[]"
                                   value="'.$value->is_vat.'">
                            <input type="text" class="form-control line-is-vat-name" style="text-align: center" value="' . $is_vat . '" disabled>
                        </td>
                            <td>
                                <input type="text" class="form-control line-deduct-remark" name="line_deduct_remark[]"
                                       value="' . $value->note . '">
                            </td>
                             <td>
                            <div class="btn btn-sm btn-danger" onclick="removedeductline($(this))">-</div>
                        </td>
                       </tr>';
            }
        } else {
//            $html.= '<tr>';
//            $html.= '<td colspan="5" style="text-align: center;color:red;">ไม่มีรายการ</td>';
//            $html.= '</tr>';

            $html .= '
            <tr>
                        <td style="text-align: center;">
                        <input type="text" style="text-align: center;" class="form-control line-num" value="" readonly></td>
                        <td>
                            <input type="hidden" class="line-deduct-title-id" name="line_deduct_title_id[]" value="">
                            <input type="text" class="form-control line-deduct-title-name"
                                   name="line_deduct_title_name[]" value="">
                        </td>
                        <td>
                            <input type="number" style="text-align: right" class="form-control line-deduct-amount" name="line_deduct_amount[]"
                                   value="" onchange="caltotaldeduct();" min="0">
                        </td>
                        <td>
                            <input type="hidden" style="text-align: right" class="form-control line-is-vat" name="line_is_vat[]"
                                   value="">
                            <input type="text" class="form-control line-is-vat-name" style="text-align: center" value="" disabled>
                        </td>
                        <td>
                            <input type="text" class="form-control line-deduct-remark" name="line_deduct_remark[]"
                                   value="">
                        </td>
                        <td>
                            <div class="btn btn-sm btn-danger" onclick="removedeductline($(this))">-</div>
                        </td>
                    </tr>
            ';

        }
        echo $html;
    }


    public function actionShowPayment()
    {
        $html = '';
        $job_id = \Yii::$app->request->post('id');
        $model = new Jobdeduct();
        $model_old = JobPayment::find()->where(['job_id' => $job_id])->all();
        if ($model_old != null) {
            foreach ($model_old as $key => $value) {
                $payment_name = \backend\models\Paymentmethod::findName($value->payment_method_id);
                $bank_name = \backend\models\Bank::findName($value->bank_id);
                $payment_date = $value->trans_date != null ? date('d-m-Y', strtotime($value->trans_date)) : '';
                 $html.= '
                    <tr data-var="'.$value->id.'">
                                <td style="text-align: center;">
                                    <input type="text" style="text-align: center;" class="form-control line-num" value="'.($key + 1).'" readonly>
                                    <input type="hidden" class="line-rec-id" name="line_rec_id[]" value="'.$value->id.'">
                                </td>
                                <td>
                                    <input type="text" class="form-control line-payment-date"
                                           name="line_payment_date[]" value="'.$payment_date.'">
                                </td>
                                <td>
                                    <input type="hidden" class="line-payment-id" name="line_payment_id[]" value="'.$value->id.'">
                                    <input type="text" class="form-control line-payment-name"
                                           name="line_payment_name[]" value="'.$payment_name.'">
                                </td>
                                <td>
                                    <input type="hidden" class="line-bank-id" name="line_bank_id[]" value="'.$value->bank_id.'">
                                    <input type="text" class="form-control line-bank-name"
                                           name="line_bank_name[]" value="'.$bank_name.'">
                                </td>
                                <td>
                                    <input type="number" style="text-align: right" class="form-control line-payment-amount" name="line_payment_amount[]"
                                           value="'.$value->amount.'" min="0" onchange="caltotalpayment()">
                                </td>
                                <td>
                                    <input type="file" class="form-control line-slip-doc" name="line_slip_doc[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control line-payment-remark" name="line_payment_remark[]"
                                           value="'.$value->note.'">
                                </td>
                                <td>
                                    <div class="btn btn-sm btn-danger" onclick="removepaymentline($(this))">-</div>
                                </td>
                            </tr>
                 ';
           }
        } else {
//            $html.= '<tr>';
//            $html.= '<td colspan="5" style="text-align: center;color:red;">ไม่มีรายการ</td>';
//            $html.= '</tr>';

            $html .= '
            <tr>
                                <td style="text-align: center;">
                                    <input type="text" style="text-align: center;" class="form-control line-num" value="" readonly>
                                     <input type="hidden" class="line-rec-id" name="line_rec_id[]" value="0">
                                </td>
                                <td>
                                    <input type="text" class="form-control line-payment-date"
                                           name="line_payment_date[]" value="">
                                </td>
                                <td>
                                    <input type="hidden" class="line-payment-id" name="line_payment_id[]" value="">
                                    <input type="text" class="form-control line-payment-name"
                                           name="line_payment_name[]" value="">
                                </td>
                                <td>
                                    <input type="hidden" class="line-bank-id" name="line_bank_id[]" value="">
                                    <input type="text" class="form-control line-bank-name"
                                           name="line_bank_name[]" value="">
                                </td>
                                <td>
                                    <input type="number" style="text-align: right" class="form-control line-payment-amount" name="line_payment_amount[]"
                                           value="" min="0" onchange="caltotalpayment()">
                                </td>
                                <td>
                                     <input type="file" class="form-control line-slip-doc" name="line_slip_doc[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control line-payment-remark" name="line_payment_remark[]"
                                           value="">
                                </td>
                                <td>
                                    <div class="btn btn-sm btn-danger" onclick="removepaymentline($(this))">-</div>
                                </td>
                            </tr>
            ';

        }
        echo $html;
    }
    public function actionCreatepayment()
    {
        $job_id = \Yii::$app->request->post('job_id');
        $payment_method_id = \Yii::$app->request->post('line_payment_id');
        $bank_id = \Yii::$app->request->post('line_bank_id');
        $amount = \Yii::$app->request->post('line_payment_amount');
        $note = \Yii::$app->request->post('line_payment_remark');
        $line_rec_id = \Yii::$app->request->post('line_rec_id');

        $payment_remove_list = \Yii::$app->request->post('payment_remove_list');

        if ($job_id) {
            if ($payment_method_id != null) {
                \common\models\JobPayment::deleteAll(['job_id' => $job_id]);
                for ($i = 0; $i <= count($payment_method_id) - 1; $i++) {

                       $filename = '';
                       $uploadedFile = \yii\web\UploadedFile::getInstanceByName('line_slip_doc[' . $i . ']');
                        if ($uploadedFile != null) {
                            $filename = $uploadedFile->name;
                            $ext = pathinfo($filename, PATHINFO_EXTENSION);
                            $filename = \Yii::$app->security->generateRandomString() . '.' . $ext;
                            $uploadedFile->saveAs(\Yii::$app->basePath . '/web/uploads/slip_doc/' . $filename);
                        }

                        $model = new JobPayment();
                        $model->job_id = $job_id;
                        $model->trans_date = date('Y-m-d H:i:s');
                        $model->bank_id = $bank_id[$i];
                        $model->amount = $amount[$i];
                        $model->note = $note[$i];
                        $model->payment_method_id = $payment_method_id[$i];
                        $model->slip_doc = $filename;
                        $model->save(false);
                }
            }

//            if($payment_remove_list != null || $payment_remove_list != ''){
//                $xp = explode(',', $payment_remove_list);
//                if (count($xp) > 0) {
//                    for ($x = 0; $x <= count($xp) - 1; $x++) {
//                        \common\models\JobPayment::deleteAll(['id' => $xp[$x]]);
//                    }
//                }
//            }
        }
        $model_line = \common\models\JobLine::find()->where(['job_id' => $job_id])->all();
        return $this->render('view', [
            'model' => $this->findModel($job_id),
            'model_line' => $model_line,
        ]);

    }
    public function actionGetemployee(){
        $html = '';
        $team_id = \Yii::$app->request->post('id');
        if($team_id != null){
            $data = [];
            $emplist = \common\models\TeamLine::find()->select(['emp_id'])->where(['team_id'=>$team_id])->all();
            if($emplist){
                foreach($emplist as $value){
                    array_push($data,$value->emp_id);
                }
                $model = \common\models\Employee::find()->where(['status' => 1,'id' => $data])->all();
                if($model){
                    $html.= '<option value="">เลือกพนักงาน</option>';
                    foreach ($model as $key => $value) {
                        $html.= '<option value="'.$value->id.'">'.$value->f_name.' '.$value->l_name.'</option>';
                    }
                }
            }

        }
        echo $html;
    }
}
