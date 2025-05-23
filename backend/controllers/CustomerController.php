<?php

namespace backend\controllers;

use backend\models\Customer;
use backend\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
//                'access' => [
//                    'class' => AccessControl::className(),
//                    'denyCallback' => function ($rule, $action) {
//                        throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
//                    },
//                    'rules' => [
//                        [
//                            'allow' => true,
//                            'roles' => ['@'],
//                            'matchCallback' => function ($rule, $action) {
//                                $currentRoute = \Yii::$app->controller->getRoute();
//                                if (\Yii::$app->user->can($currentRoute)) {
//                                    return true;
//                                }
//                            }
//                        ]
//                    ]
//                ],
            ]
        );
    }

    /**
     * Lists all Customer models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $pageSize = \Yii::$app->request->post("perpage");

        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andFilterWhere(['can_new'=>0]);

        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Customer model.
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
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Customer();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $party_type = 2;
                $address = \Yii::$app->request->post('cus_address');
                $street = \Yii::$app->request->post('cus_street');
                $district_id = \Yii::$app->request->post('district_id');
                $city_id = \Yii::$app->request->post('city_id');
                $province_id = \Yii::$app->request->post('province_id');
                $zipcode = \Yii::$app->request->post('zipcode');

                $line_contact_name = \Yii::$app->request->post('line_name');
                $line_type_id = \Yii::$app->request->post('line_type_id');
                $line_contact_no = \Yii::$app->request->post('line_contact_no');


                $customer_payment_tax_id = \Yii::$app->request->post('customer_tax_id');
                $customer_payment_tax_branch = \Yii::$app->request->post('customer_tax_branch');
                $customer_payment_tax_email = \Yii::$app->request->post('customer_tax_email');


                $address2 = \Yii::$app->request->post('cus_address2');
                $street2 = \Yii::$app->request->post('cus_street2');
                $district_id2 = \Yii::$app->request->post('district_id2');
                $city_id2 = \Yii::$app->request->post('city_id2');
                $province_id2 = \Yii::$app->request->post('province_id2');
                $zipcode2 = \Yii::$app->request->post('zipcode2');

                $contact_dept_name = \Yii::$app->request->post('line_dept_name');
                $contact_name = \Yii::$app->request->post('line_contact_name');

            //    print_r($line_contact_name);return ;
                $model->can_new = 0;
                if ($model->save()) {
                    if ($party_type) {
//                        echo $address;
//                        echo $zipcode; return ;
                        $address_chk = \common\models\AddressInfo::find()->where(['party_id' => $model->id, 'party_type_id' => $party_type, 'address_type_id' => 1])->one();
                        if ($address_chk) {
                            $address_chk->address = $address;
                            $address_chk->street = $street;
                            $address_chk->district_id = $district_id;
                            $address_chk->city_id = $city_id;
                            $address_chk->province_id = $province_id;
                            $address_chk->zipcode = $zipcode;
                            $address_chk->status = 1;
                            if ($address_chk->save()) {

                            }
                        } else {
                            $cus_address = new \common\models\AddressInfo();
                            $cus_address->party_type_id = $party_type;
                            $cus_address->party_id = $model->id;
                            $cus_address->address = $address;
                            $cus_address->street = $street;
                            $cus_address->district_id = $district_id;
                            $cus_address->city_id = $city_id;
                            $cus_address->province_id = $province_id;
                            $cus_address->zipcode = $zipcode;
                            $cus_address->status = 1;
                            $cus_address->address_type_id = 1; // 1 = invoice
                            if ($cus_address->save(false)) {

                            }
                        }

                        $address_chk2 = \common\models\AddressInfo::find()->where(['party_id' => $model->id, 'party_type_id' => $party_type, 'address_type_id' => 2])->one();
                        if ($address_chk2) {
                            $address_chk2->address = $address;
                            $address_chk2->street = $street;
                            $address_chk2->district_id = $district_id;
                            $address_chk2->city_id = $city_id;
                            $address_chk2->province_id = $province_id;
                            $address_chk2->zipcode = $zipcode;
                            $address_chk2->status = 1;
                            if ($address_chk2->save(false)) {

                            }
                        } else {
                            $cus_address2 = new \common\models\AddressInfo();
                            $cus_address2->party_type_id = $party_type;
                            $cus_address2->party_id = $model->id;
                            $cus_address2->address = $address2;
                            $cus_address2->street = $street2;
                            $cus_address2->district_id = $district_id2;
                            $cus_address2->city_id = $city_id2;
                            $cus_address2->province_id = $province_id2;
                            $cus_address2->zipcode = $zipcode2;
                            $cus_address2->status = 1;
                            $cus_address2->address_type_id = 2; // 2 = delivery
                            if ($cus_address2->save(false)) {

                            }
                        }
                    }

                    if($contact_dept_name!=null){
                        for($x=0;$x<count($contact_dept_name);$x++){
                            $model_contact = new \common\models\ContactInfo();
                            $model_contact->party_type_id = $party_type;
                            $model_contact->party_ref_id = $model->id;
                            $model_contact->contact_name = $contact_name[$x];
                            $model_contact->dept_name = $contact_dept_name[$x];
                            $model_contact->status = 1;
                            if ($model_contact->save(false)) {

                            }
                        }
                    }

//                    if (count($line_contact_name)) {
////                        echo count($line_contact_name);return ;
//                        for ($i = 0; $i <= count($line_contact_name) - 1; $i++) {
////                            print_r($line_contact_name);return ;
//                            if ($line_contact_name[$i]) {
////                              print_r($line_contact_name);return ;
//                                $contact_chk = \common\models\ContactInfo::find()->where(['party_id' => $model->id, 'contact_name' => $line_contact_name[$i]])->one();
//                                if ($contact_chk) {
////                                    $contact_chk->type_id = $line_type_id[$i];
//                                    $contact_chk->contact_name = trim($line_contact_name[$i]);
//                                    $contact_chk->type_id = $line_type_id[$i];
//                                    $contact_chk->contact_no = trim($line_contact_no[$i]);
//                                    if ($contact_chk->save(false)) {
//
//                                    }
//                                } else {
//                                    $new_contact = new \common\models\ContactInfo();
//                                    $new_contact->party_type = $party_type;
//                                    $new_contact->party_id = $model->id;
//                                    $new_contact->type_id = $line_type_id[$i];
//                                    $new_contact->contact_name = trim($line_contact_name[$i]);
//                                    $new_contact->contact_no = trim($line_contact_no[$i]);
//                                    if ($new_contact->save(false)) {
//
//                                    }
//                                }
//                            }
////                            print_r($line_contact_name);return ;
//
//                        }
//
//                    }

//                    $model_tax = new \common\models\CustomerInvoiceInfo();
//                    $model_tax->customer_id = $model->id;
//                    $model_tax->tax_id = $customer_payment_tax_id;
//                    $model_tax->branch = $customer_payment_tax_branch;
//                    $model_tax->email = $customer_payment_tax_email;
//                    $model_tax->status = 1;
//                    $model_tax->save(false);
//
//
//                    if ($model->customer_group_id) {
//                        for ($m = 0; $m <= count($model->customer_group_id) - 1; $m++) {
//                            $model_group_assign = new \common\models\CustomerAssignList();
//                            $model_group_assign->customer_id = $model->id;
//                            $model_group_assign->group_id = $model->customer_group_id[$m];
//                            $model_group_assign->save(false);
//                        }
//                    }
                    //return $this->redirect(['view', 'id' => $model->id]);
                    \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'บันทึกข้อมูลเรียบร้อยแล้ว'));
                    return $this->redirect(['index']);
                }

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'model_contact_info' => null,
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model_line = \common\models\AddressInfo::find()->where(['party_id' => $id])->all();
        $model_delivery_address = \common\models\AddressInfo::find()->where(['party_id' => $id, 'address_type_id' => 2])->one();
        $model_contact_info = \common\models\ContactInfo::find()->where(['party_ref_id' => $id,'party_type_id'=>2])->all();

        //$model_contact_line = \common\models\ContactInfo::find()->where(['party_id' => $id])->all();

//        $model_customer_tax_info = \common\models\CustomerInvoiceInfo::find()->where(['customer_id' => $id])->one();
//
//        $model_user_group_list = \common\models\CustomerAssignList::find()->where(['customer_id'=>$id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $party_type = 2;
            $address = \Yii::$app->request->post('cus_address');
            $street = \Yii::$app->request->post('cus_street');
            $district_id = \Yii::$app->request->post('district_id');
            $city_id = \Yii::$app->request->post('city_id');
            $province_id = \Yii::$app->request->post('province_id');
            $zipcode = \Yii::$app->request->post('zipcode');

            $address2 = \Yii::$app->request->post('cus_address2');
            $street2 = \Yii::$app->request->post('cus_street2');
            $district_id2 = \Yii::$app->request->post('district_id2');
            $city_id2 = \Yii::$app->request->post('city_id2');
            $province_id2 = \Yii::$app->request->post('province_id2');
            $zipcode2 = \Yii::$app->request->post('zipcode2');

            $contact_dept_name = \Yii::$app->request->post('line_dept_name');
            $contact_name = \Yii::$app->request->post('line_contact_name');
            $line_rec_id = \Yii::$app->request->post('rec_id');
            $removelist = \Yii::$app->request->post('remove_list');


      //      print_r($removelist); return;
            if ($model->save(true)) {
                if ($party_type) {
//                    echo 'dd'; return
                    $address_chk = \common\models\AddressInfo::find()->where(['party_id' => $model->id, 'party_type_id' => $party_type, 'address_type_id' => 1])->one();
//                    echo 'dd'; return;
                    if ($address_chk) {
                        $address_chk->party_type_id = $party_type;
                        $address_chk->address = $address;
                        $address_chk->street = $street;
                        $address_chk->district_id = $district_id;
                        $address_chk->city_id = $city_id;
                        $address_chk->province_id = $province_id;
                        $address_chk->zipcode = $zipcode;
                        $address_chk->status = 1;
                        if ($address_chk->save(false)) {

                        }
                    } else {
                        $new_address = new \common\models\AddressInfo();
                        $new_address->party_type_id = $party_type;
                        $new_address->party_id = $model->id;
                        $new_address->address = $address;
                        $new_address->street = $street;
                        $new_address->district_id = $district_id;
                        $new_address->city_id = $city_id;
                        $new_address->province_id = $province_id;
                        $new_address->zipcode = $zipcode;
                        $new_address->address_type_id = 1;
                        $new_address->status = 1;
                        if ($new_address->save(false)) {

                        }
                    }

                    $address_chk2 = \common\models\AddressInfo::find()->where(['party_id' => $model->id, 'party_type_id' => $party_type, 'address_type_id' => 2])->one();
                    if ($address_chk2) {
                        $address_chk2->address = $address2;
                        $address_chk2->street = $street2;
                        $address_chk2->district_id = $district_id2;
                        $address_chk2->city_id = $city_id2;
                        $address_chk2->province_id = $province_id2;
                        $address_chk2->zipcode = $zipcode2;
                        $address_chk2->status = 1;
                        if ($address_chk2->save(false)) {

                        }
                    } else {
                        $cus_address2 = new \common\models\AddressInfo();
                        $cus_address2->party_type_id = $party_type;
                        $cus_address2->party_id = $model->id;
                        $cus_address2->address = $address2;
                        $cus_address2->street = $street2;
                        $cus_address2->district_id = $district_id2;
                        $cus_address2->city_id = $city_id2;
                        $cus_address2->province_id = $province_id2;
                        $cus_address2->zipcode = $zipcode2;
                        $cus_address2->status = 1;
                        $cus_address2->address_type_id = 2; // 2 = delivery
                        if ($cus_address2->save(false)) {

                        }
                    }
                }

                if($contact_dept_name!=null){
                    for($x=0;$x<count($contact_dept_name);$x++){
                        $model_check = \common\models\ContactInfo::find()->where(['id'=>$line_rec_id[$x]])->one();
                        if($model_check){
                            $model_check->dept_name = $contact_dept_name[$x];
                            $model_check->contact_name = $contact_name[$x];
                            $model_check->save(false);
                        }else{
                            $model_contact = new \common\models\ContactInfo();
                            $model_contact->party_type_id = $party_type;
                            $model_contact->party_ref_id = $model->id;
                            $model_contact->contact_name = $contact_name[$x];
                            $model_contact->dept_name = $contact_dept_name[$x];
                            $model_contact->status = 1;
                            if ($model_contact->save(false)) {

                            }
                        }
                    }
                }

                if($removelist!=null){
                  //  print_r($removelist); return;
                    $delx = explode(",",$removelist);
                    if($delx!=null){
                        for($x=0;$x<=count($delx)-1;$x++){
                            \common\models\ContactInfo::deleteAll(['id'=>$delx[$x]]);
                        }
                    }else{
                        \common\models\ContactInfo::deleteAll(['id'=>$removelist]);
                    }
                }


            }
           // return $this->redirect(['view', 'id' => $model->id]);
            \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'บันทึกข้อมูลเรียบร้อยแล้ว'));
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'model_delivery_address' => $model_delivery_address,
            'model_contact_info' => $model_contact_info,
//            'model_line' => $model_line,
//            'model_contact_line' => $model_contact_line,
//            'model_customer_tax_info' => $model_customer_tax_info,
//            'model_user_group_list' => $model_user_group_list,
        ]);
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id)
    {
        $model_address = \common\models\AddressInfo::find()->where(['party_id' => $id])->all();
        if ($model_address) {
            if (\common\models\AddressInfo::deleteAll(['party_id' => $id])) {
//                $this->findModel($id)->delete();
            }
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = Customer::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public
    function actionShowcity($id)
    {
        $model = \common\models\Amphur::find()->where(['PROVINCE_ID' => $id])->all();

        if (count($model) > 0) {
            echo "<option>--- เลือกอำเภอ ---</option>";
            foreach ($model as $value) {

                echo "<option value='" . $value->AMPHUR_ID . "'>$value->AMPHUR_NAME</option>";

            }
        } else {
            echo "<option>-</option>";
        }
    }

    public
    function actionShowdistrict($id)
    {
        $model = \common\models\District::find()->where(['AMPHUR_ID' => $id])->all();

        if (count($model) > 0) {
            foreach ($model as $value) {

                echo "<option value='" . $value->DISTRICT_ID . "'>$value->DISTRICT_NAME</option>";

            }
        } else {
            echo "<option>-</option>";
        }
    }

    public function actionShowzipcode($id)
    {
        $model = \common\models\Amphur::find()->where(['AMPHUR_ID' => $id])->one();
//        echo $id;
        if ($model) {
            echo $model->POSTCODE;
//            echo '1110';
        } else {
            echo "";
        }
//        echo '111';
    }

    public function actionFindattn(){
        $html = '';
        $id = \Yii::$app->request->post('id');
        if($id){
            $model = \common\models\ContactInfo::find()->where(['party_ref_id'=>$id,'party_type_id'=>2])->all();
            if($model){
                foreach ($model as $value) {
                    $html .= "<option value='".$value->id."'>".$value->dept_name." " . $value->contact_name."</option>";
                }
            }
        }

        echo $html;
    }


}
