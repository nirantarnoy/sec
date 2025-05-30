<?php

namespace backend\controllers;

use backend\models\Job;
use backend\models\Jobdeduct;
use backend\models\JobSearch;
use backend\models\TeamSearch;
use common\models\JobPayment;
use common\models\JobProfitComStd;
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

                $line_stock_id = \Yii::$app->request->post('line_stock_id');

                $model->job_no = $model::getLastNo();
                $trans_date = date('Y-m-d H:is');
                $xdate = explode('-', $model->trans_date);
                if ($xdate != null) {
                    if (count($xdate) > 1) {
                        $trans_date = $xdate[2] . '/' . $xdate[1] . '/' . $xdate[0];
                    }
                }
                $model->pending_amount = str_replace(',', '', $model->pending_amount);
                $model->payment_status = 1;
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
                                $model_line->stock_type_id = $line_stock_id[$i];
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
            $job_value_amount = \Yii::$app->request->post('job_value_amount');

            $line_vat_type = \Yii::$app->request->post('line_vat_type');
            $line_withholding_type = \Yii::$app->request->post('line_withholding_type');
            $line_distributor_id = \Yii::$app->request->post('line_distributor_id');

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

           // echo $job_value_amount;return;

            $new_job_value_amount = 0;
            $new_pending_amount = 0;

            if ($model->set_to_zero == 1){
                $amont_replace = str_replace(',', '', $model->pending_amount);
                $new_pending_amount = floor($amont_replace);

                $value_amt = str_replace(',', '', $job_value_amount);
                $new_job_value_amount = floor($value_amt);
            }else{
                $new_pending_amount = str_replace(',', '', $model->pending_amount);
                $new_job_value_amount = str_replace(',', '', $job_value_amount);
            }

          //  echo $new_job_value_amount;return;



           // $model->trans_date = date('Y-m-d', strtotime($trans_date));
            $model->pending_amount = $new_pending_amount;
            $model->job_value_amount = $new_job_value_amount;
            $model->paid_amount = str_replace(',', '', $model->paid_amount);
            $model->withholding_amount = 0;
            $model->payment_amount = 0;
            $model->status = 1;
            if ($model->save(false)) {
                if ($line_product_id != null) {
                    if (count($line_product_id) > 0) {
                        for ($i = 0; $i <= count($line_product_id) - 1; $i++) {

                            $whd_amt = 0;
                            if($line_withholding_type[$i] == 1){
                                $whd_amt = ($line_total_quote_price[$i] * 3) / 100;
                            }

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
                                $check_has->vat_type = $line_vat_type[$i];
                                $check_has->withholdingtax = $line_withholding_type[$i];
                                $check_has->distributor_id = $line_distributor_id[$i];
                                $check_has->withholding_tax_amount = $whd_amt;
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
                                $model_line->vat_type = $line_vat_type[$i];
                                $model_line->withholdingtax = $line_withholding_type[$i];
                                $model_line->distributor_id = $line_distributor_id[$i];
                                $model_line->withholding_tax_amount = $whd_amt;
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
                   // \backend\models\Job::updateAll(['job_value_amount' => 0, ['id' => $model->id]]);
                    $this->calJobsummary($model->id,$model->job_master_id);
                }
                \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'บันทึกข้อมูลเรียบร้อยแล้ว'));
               // return $this->redirect(['index']);
              //  return $this->redirect(['jobmain/update', 'id' => $model->job_master_id]);
                return $this->redirect(['job/update', 'id' => $id]);
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

        $saved_status = 0;
        $total_payment = 0;
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
                        if($model->save(false)){
                            $total_payment+=$amount[$i];
                            $saved_status +=1;
                        }
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
        if($saved_status > 0){
            $model_check_paid = \common\models\Job::find()->where(['id' => $job_id])->one();
            if($model_check_paid){
                 $pending_amt = $this->getPaidPending($job_id);
                 if($pending_amt <= 0){
                     $model_check_paid->payment_status = 3;
                     $model_check_paid->paid_amount = $total_payment;
                     $model_check_paid->pending_amount = 0;
                     $model_check_paid->save(false);
                 }else{
                     $model_check_paid->payment_status = 2;
                     $model_check_paid->paid_amount = $total_payment;
                     $model_check_paid->pending_amount = $pending_amt;
                     $model_check_paid->save(false);
                 }
            }

        }

        $model_line = \common\models\JobLine::find()->where(['job_id' => $job_id])->all();
        return $this->render('view', [
            'model' => $this->findModel($job_id),
            'model_line' => $model_line,
        ]);

    }
    function getPaidPending($id)
    {
        $pending_amount = 0;
        if ($id) {
            $model = \common\models\JobPayment::find()->where(['job_id' => $id])->sum('amount');
            $model_job_amount = \common\models\Job::find()->where(['id' => $id])->sum('job_value_amount');
            if ($model) {
                $pending_amount = $model_job_amount - $model;
            } else {
                if ($model_job_amount) {
                    $pending_amount = $model_job_amount;
                }
            }
        }
        return $pending_amount;
    }
    function getJobpayment($id)
    {
        $amt = 0;
        if ($id) {
            $amt = \common\models\JobPayment::find()->where(['job_id' => $id])->sum('amount');
        }
        return $amt;
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

    function calJobsummary($job_id,$job_master_id){
        if($job_id){
            $model = \common\models\ViewJobData::find()->where(['id' => $job_id])->all();
            if($model){
                $cost_with_vat = 0;
                $cost_without_vat = 0;
                $total_cost = 0;
                $job_value_amount = 0;
                $withholding_amt = 0;
                $total_after_deduct_vat_per = 0;
                foreach($model as $value){
                    $cost_with_vat = $cost_with_vat + $this->sumcostvat($job_id, $value->cal_type_id, 1);
                    $cost_without_vat = $cost_without_vat + $this->sumcostvat($job_id, $value->cal_type_id, 2);
                    $job_value_amount = $value->job_value_amount;
                    $withholding_amt = $withholding_amt + $value->withholding_tax_amount;
                }
                $total_cost = $cost_with_vat + $cost_without_vat;
               // $total_cost_with_vat = $cost_with_vat + $this->getJobVat($job_id)-($cost_with_vat - ($cost_with_vat  / 1.07)) + $cost_without_vat;
                $total_after_deduct_vat = $job_value_amount-($cost_with_vat + $this->getJobVat($job_id)-($cost_with_vat - ($cost_with_vat  / 1.07)) + $cost_without_vat);
                if($total_after_deduct_vat > 0 && $job_value_amount > 0){
                    $total_after_deduct_vat_per = ($total_after_deduct_vat/$job_value_amount)*100;
                }

                $total_commission = 0.27 *$total_after_deduct_vat;


                if($total_cost >0){
                    \backend\models\Job::updateAll([
                        'job_cost_amount' => $total_cost,
                        'job_benefit_amount'=>$total_after_deduct_vat,
                        'job_benefit_per'=>$total_after_deduct_vat_per,
                        'commission_amount'=>$total_commission,
                        'withholding_amount'=>$withholding_amt,
                        'job_value_amount'=>$job_value_amount,
                        'pending_amount'=>0,
                    ], ['id' => $job_id]);


                    $update_pending_amt = $this->getPaidPending($job_id);
                    if($update_pending_amt){
                        \backend\models\Job::updateAll(['pending_amount'=>$update_pending_amt],['id'=>$job_id]);
                    }

                    $model_std_profit = \common\models\JobProfitComStd::find()->where(['job_id'=>$job_master_id,'type_id'=>1])->one();
                    if($model_std_profit){
                        $new_com_amount = ($total_after_deduct_vat * $model_std_profit->commission_per) / 100;
                        \common\models\JobProfitComStd::updateAll(['commission_amount'=>$new_com_amount],['job_id'=>$job_master_id,'type_id'=>1]);
                    }

                   // \common\models\JobProfitComStd::updateAll(['std_amount'=>$total_after_deduct_vat],['job_id'=>$job_master_id,'type_id'=>1]);

                    $model_std_profit_new_all_cal = \common\models\JobProfitComStd::find()->where(['job_id'=>$job_master_id,'type_id'=>[0]])->all();
                    if($model_std_profit_new_all_cal){
                        $new_com_amount_2 = 0;
                        $new_com_per_2 = 0;
                        $new_commission_amount_2 = 0;

                        foreach ($model_std_profit_new_all_cal as $valuex) {
                            $new_com_amount_2 += ($valuex->std_amount);
                            $new_commission_amount_2 += ($valuex->commission_amount);
                        }

                        $new_xx_com_amount = 0;
                        $new_xx_std_com_amount =0;

                        $model_xx = \common\models\JobProfitComStd::find()->where(['job_id'=>$job_master_id,'type_id'=>1])->one();
                        if($model_xx){
                            $new_xx_com_amount = (($model_xx->std_amount + $total_after_deduct_vat) * $model_xx->commission_per) / 100;
                            $new_xx_std_com_amount = ($model_xx->std_amount + $total_after_deduct_vat);
                            $model_xx->std_amount = ($model_xx->std_amount + $total_after_deduct_vat);
                            $model_xx->commission_amount = $new_xx_com_amount;
                            $model_xx->save(false);
                        }



                        $new_com_per_2 = (($new_commission_amount_2 + $new_xx_com_amount) * 100) / ($new_com_amount_2 + $new_xx_std_com_amount);
                        \common\models\JobProfitComStd::updateAll(['std_amount'=>($new_com_amount_2 + $new_xx_std_com_amount),'commission_amount'=>($new_commission_amount_2+$new_xx_com_amount),'commission_per'=>$new_com_per_2],['job_id'=>$job_master_id,'type_id'=>2]);

                    }else{
                       // \common\models\JobProfitComStd::updateAll(['std_amount'=>$total_after_deduct_vat],['job_id'=>$job_master_id,'type_id'=>1]);
                    }


                }
            }
        }
    }
    function sumcostvat($job_id, $deduct_id, $vat_type)
    {
        $amount = 0;
        if ($job_id && $deduct_id) {
            if ($vat_type == 1) {
                $model = \common\models\ViewJobData::find()->where(['id' => $job_id, 'cal_type_id' => $deduct_id, 'vat_type' => 1])->sum('cost_total');
                if ($model) {
                    $amount = $model;
                }
            } else {
                $model = \common\models\ViewJobData::find()->where(['id' => $job_id, 'cal_type_id' => $deduct_id, 'vat_type' => [2, 3]])->sum('cost_total');
                if ($model) {
                    $amount = $model;
                }
            }

        }
        return $amount;
    }
    function sumcost($job_id, $deduct_id, $type_id)
    {
        $amount = 0;
        if ($job_id && $deduct_id) {
            if ($type_id == 1) {
                $model = \common\models\ViewJobData::find()->where(['id' => $job_id, 'cal_type_id' => $deduct_id, 'vat_type' => 1])->sum('cost_total');
                if ($model) {
                    $amount = $model;
                }
            } else {
                $model = \common\models\ViewJobData::find()->where(['id' => $job_id, 'cal_type_id' => $deduct_id, 'vat_type' => [2, 3]])->sum('cost_total');
                if ($model) {
                    $amount = $model;
                }
            }

        }
        return $amount;
    }
    function getJobVat($job_id){
        $amount = 0;
        if($job_id){
            $model = \common\models\ViewJobData::find()->where(['id'=>$job_id])->sum('total_quotation_price');
            if($model){
                $amount = ($model * 7) / 100;
            }
        }
        return $amount;
    }

    function actionCopyjob(){
        $job_id = \Yii::$app->request->post('job_id');
        $quotation_no = \Yii::$app->request->post('quotation_no');
        $invoice_no = \Yii::$app->request->post('invoice_no');
        $new_job_id = 0;
        if($job_id){
            $model_org = \backend\models\Job::find()->where(['id'=>$job_id])->one();
            if($model_org){
                $model = new \backend\models\Job();
                $model->job_no = $model::getLastNo();
                $model->trans_date = date('Y-m-d');
                $model->job_master_id = $model_org->job_master_id;
               // $model->customer_id = $model_org->customer_id;
                $model->quotation_ref_no = $quotation_no;
                $model->invoice_ref_no = $invoice_no;
                $model->team_id = $model_org->team_id;
                $model->head_id = $model_org->head_id;
                $model->payment_status = 1;
                $model->status = 1;
                $model->job_value_amount = 0;
                if($model->save(false)){
                    $new_job_id = $model->id;
                    $model_line_org = \common\models\JobLine::find()->where(['job_id'=>$job_id])->all();
                    if($model_line_org){
                        foreach ($model_line_org as $model_line){
                            $model_line_new = new \common\models\JobLine();
                            $model_line_new->job_id = $model->id;
                            $model_line_new->product_id = $model_line->product_id;
                            $model_line_new->product_name = $model_line->product_name;
                            $model_line_new->cost_per_unit = 0;
                            $model_line_new->discount_per = 0;
                            $model_line_new->dealer_price = 0;
                            $model_line_new->vat_amount = 0;
                            $model_line_new->total_cost_per_unit = 0;
                            $model_line_new->qty = 0;
                            $model_line_new->cost_total =0;
                            $model_line_new->quotation_per_unit_price = 0;
                            $model_line_new->total_quotation_price = 0;
                            $model_line_new->vat_type = $model_line->vat_type;
                            $model_line_new->withholdingtax = $model_line->withholdingtax;
                            $model_line_new->distributor_id = $model_line->distributor_id;
                            $model_line_new->save(false);
                        }
                    }
                }
            }
        }
        //$model = $this->findModel($new_job_id);
        //$model_line = \common\models\JobLine::find()->where(['job_id' => $new_job_id])->all();
        return $this->redirect(['job/update', 'id'=>$new_job_id]);

    }

    public function actionCreatepaymentnew()
    {
        $job_id = \Yii::$app->request->post('job_id');
        $payment_method_id = \Yii::$app->request->post('payment_method_id');
        $bank_id = \Yii::$app->request->post('bank_id');
        $amount = \Yii::$app->request->post('payment_amount');
        $fee_amount = \Yii::$app->request->post('fee_amount');
        $note = \Yii::$app->request->post('line_payment_remark');
        $line_rec_id = \Yii::$app->request->post('line_rec_id');

        $payment_remove_list = \Yii::$app->request->post('payment_remove_list');

        $saved_status = 0;
        $total_payment = 0;
        if ($job_id) {
            if ($payment_method_id != null) {



//                    $filename = '';
//                    $uploadedFile = \yii\web\UploadedFile::getInstanceByName('line_slip_doc[' . $i . ']');
//                    if ($uploadedFile != null) {
//                        $filename = $uploadedFile->name;
//                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
//                        $filename = \Yii::$app->security->generateRandomString() . '.' . $ext;
//                        $uploadedFile->saveAs(\Yii::$app->basePath . '/web/uploads/slip_doc/' . $filename);
//                    }

                    $filename = '';
                    $uploadedFile = \yii\web\UploadedFile::getInstanceByName('payment_slip');
                    if ($uploadedFile != null) {
                        $filename = $uploadedFile->name;
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        $filename = \Yii::$app->security->generateRandomString() . '.' . $ext;
                        $uploadedFile->saveAs(\Yii::$app->basePath . '/web/uploads/slip_doc/' . $filename);
                    }

                    $model = new JobPayment();
                    $model->job_id = $job_id;
                    $model->trans_date = date('Y-m-d H:i:s');
                    $model->bank_id = 0;
                    $model->amount = $amount;
                    $model->fee_amount = $fee_amount;
                    $model->total_amount = $amount + $fee_amount;
                    $model->note = $note;
                    $model->payment_method_id = $payment_method_id;
                    $model->slip_doc = $filename;
                    if($model->save(false)){
                        $total_payment+=$amount;
                        $saved_status +=1;
                    }

            }

        }
        if($saved_status > 0){
            $model_check_paid = \common\models\Job::find()->where(['id' => $job_id])->one();
            if($model_check_paid){
                $pending_amt = $this->getPaidPending($job_id);
                if($pending_amt <= 0){
                    $model_check_paid->payment_status = 3;
                    $model_check_paid->paid_amount = $total_payment;
                    $model_check_paid->pending_amount = 0;
                    $model_check_paid->save(false);
                }else{
                    $model_check_paid->payment_status = 2;
                    $model_check_paid->paid_amount = $total_payment;
                    $model_check_paid->pending_amount = $pending_amt;
                    $model_check_paid->save(false);
                }
            }
        }
        return $this->redirect(['job/update', 'id'=>$job_id]);

//        $model_line = \common\models\JobLine::find()->where(['job_id' => $job_id])->all();
//        return $this->render('view', [
//            'model' => $this->findModel($job_id),
//            'model_line' => $model_line,
//        ]);

    }

    function actionRemovepaymentline(){
        $id = \Yii::$app->request->post('id');
        $job_id = \Yii::$app->request->post('job_id');
        $res = 0;
        $total_payment = 0;
        if($id){
            if(\common\models\JobPayment::deleteAll(['id' => $id])){
                $res = 1;
                $model_check_paid = \common\models\Job::find()->where(['id' => $job_id])->one();
                $pending_amt = $this->getPaidPending($job_id);

                $total_payment = $this->getJobpayment($job_id);
                if($pending_amt <= 0){
                    $model_check_paid->payment_status = 3;
                    $model_check_paid->paid_amount = $total_payment;
                    $model_check_paid->pending_amount = 0;
                    $model_check_paid->save(false);
                }else{
                    if($total_payment <=0){
                        $model_check_paid->payment_status = 1;
                        $model_check_paid->paid_amount = $total_payment;
                        $model_check_paid->pending_amount = $model_check_paid->job_value_amount;
                        $model_check_paid->save(false);
                    }else{
                        $model_check_paid->payment_status = 2;
                        $model_check_paid->paid_amount = $total_payment;
                        $model_check_paid->pending_amount = $pending_amt;
                        $model_check_paid->save(false);
                    }

                }
            }
        }

        echo $res;
    }

    public function actionCreatedistributor(){
        $new_id = 0;
        $html= '';
        $name = \Yii::$app->request->post('name');
        $description = \Yii::$app->request->post('description');
        if($name){
            $model = new \common\models\Distributor();
            $model->name = $name;
            $model->description = $description;
            $model->status = 1;
            $model->can_new = 0;
            if($model->save(true)){
                $new_id = $model->id;
                $model_list = \backend\models\Distributor::find()->where(['status'=>1])->orderBy(['can_new'=>SORT_ASC])->all();
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
        echo $html;
    }

    public function actionSubmitjob(){
        $job_id = \Yii::$app->request->post('job_id');
        $model = \common\models\Job::find()->where(['id'=>$job_id])->one();
        if($model){
            $model->status = 2; //submit job to finance check
            $model->save(false);
        }
        \Yii::$app->session->setFlash('msg-success', 'submit ใบงานให้แผนกบัญชีตรวจสอบแล้ว.');
        return $this->redirect(['job/update', 'id'=>$job_id]);
    }
    public function actionPaymentreviewjob(){
        $job_id = \Yii::$app->request->post('job_id');
        $model = \common\models\Job::find()->where(['id'=>$job_id])->one();
        if($model){
            $model->status = 3; // review payment
            $model->save(false);
        }
        \Yii::$app->session->setFlash('msg-success', 'Payment review ใบงานเรียบร้อยแล้ว.');
        return $this->redirect(['job/update', 'id'=>$job_id]);
    }
}
