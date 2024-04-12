<?php

namespace backend\controllers;

use backend\models\Uploadfile;
use common\models\LoginForm;
use Yii;
use backend\models\Member;
use backend\models\MemberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\UploadedFile;

class MainconfigController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $model_file = new Uploadfile();
        return $this->render('index', [
            'model_file' => $model_file
        ]);
    }

//    public function actionImportcustomer()
//    {
//            $uploaded = UploadedFile::getInstanceByName( 'file_customer');
//            if (!empty($uploaded)) {
//                //echo "ok";return;
//                $upfiles = time() . "." . $uploaded->getExtension();
//                // if ($uploaded->saveAs(Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles)) {
//                if ($uploaded->saveAs('../web/uploads/files/customers/' . $upfiles)) {
//                    //  echo "okk";return;
//                    // $myfile = Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles;
//                    $myfile = '../web/uploads/files/customers/' . $upfiles;
//                    $file = fopen($myfile, "r");
//                    fwrite($file, "\xEF\xBB\xBF");
//
//                    setlocale(LC_ALL, 'th_TH.TIS-620');
//                    $i = -1;
//                    $res = 0;
//                    $data = [];
//                    while (($rowData = fgetcsv($file, 10000, ",")) !== FALSE) {
//                        $i += 1;
//                        $catid = 0;
//                        $qty = 0;
//                        $price = 0;
//                        $cost = 0;
//                        if ($rowData[1] == '' || $i == 0) {
//                            continue;
//                        }
//
//                        $model_dup = \backend\models\Customer::find()->where(['name'=>trim($rowData[1])])->one();
//                        if ($model_dup != null) {
//                            continue;
//                        }
//
//                        $route_id = $this->checkRoute($rowData[11]);
//                        $group_id = $this->checkCustomergroup($rowData[13]);
//                        $type_id = $this->checkCustomertype($rowData[14]);
//                       // $payment_method = $this->checkPaymethod($rowData[4]);
//                        $payment_term = $this->checkPayterm($rowData[6]);
//
//                        $modelx = new \backend\models\Customer();
//                        $modelx->code = $rowData[0];
//                        $modelx->name = $rowData[1];
//                        $modelx->description = $rowData[1];
//                        $modelx->contact_name = '';
//                        $modelx->branch_no = $rowData[2];
//                        $modelx->location_info = $rowData[10];
//                        $modelx->customer_group_id = $group_id;
//                        $modelx->customer_type_id = $type_id;
//                        $modelx->delivery_route_id = $route_id;
//                        $modelx->address = $rowData[4];
//                        $modelx->address2 = $rowData[3];
//                        $modelx->phone = $rowData[15];
//                      //  $modelx->payment_method_id = $payment_method;
//                        $modelx->payment_term_id = $payment_term;
//                        $modelx->status = 1;
//                        if ($modelx->save(false)) {
//                            $res += 1;
//                        }
//                    }
//                    //    print_r($qty_text);return;
//
//                    if ($res > 0) {
//                        $session = Yii::$app->session;
//                        $session->setFlash('msg', 'นำเข้าข้อมูลเรียบร้อย');
//                        return $this->redirect(['index']);
//                    } else {
//                        $session = Yii::$app->session;
//                        $session->setFlash('msg-error', 'พบข้อมผิดพลาด');
//                        return $this->redirect(['index']);
//                    }
//                    // }
//                    fclose($file);
////            }
////        }
//                }
//            }
//    }
    public function actionImportcustomer()
    {
        $uploaded = UploadedFile::getInstanceByName('file_customer');
        if (!empty($uploaded)) {
            //echo "ok";return;
            $upfiles = time() . "." . $uploaded->getExtension();
            // if ($uploaded->saveAs(Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles)) {
            if ($uploaded->saveAs('../web/uploads/files/customers/' . $upfiles)) {
                //  echo "okk";return;
                // $myfile = Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles;
                $myfile = '../web/uploads/files/customers/' . $upfiles;
                $file = fopen($myfile, "r+");
                fwrite($file, "\xEF\xBB\xBF");

                setlocale(LC_ALL, 'th_TH.TIS-620');
                $i = -1;
                $res = 0;
                $data = [];
                $loop = 0;
                while (($rowData = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $i += 1;
                    $catid = 0;
                    $qty = 0;
                    $price = 0;
                    $cost = 0;


                    if ($rowData[1] == '' || $i == 0) {
                        continue;
                    }

                    $model_dup = \backend\models\Customer::find()->where(['name' => trim($rowData[1]), 'company_id' => 1])->one();
                    if ($model_dup != null) {
                        $loop++;
                        continue;
                    }

//                    $route_id = $this->checkRoute($rowData[3]);
                    $group_id = $this->checkCustomergroup($rowData[2]);
//                    $type_id = $this->checkCustomertype($rowData[6]);
//                    $payment_method = $this->checkPaymethod($rowData[14]);
//                    $payment_term = $this->checkPayterm($rowData[15]);

                    $customer_name = $rowData[1];
                    $customer_group = $rowData[2];
                    $tax_id = $rowData[3];
                    $address = $rowData[4];
                    $street = $rowData[5];
                    $district = $rowData[6];
                    $city = $rowData[7];
                    $province = $rowData[8];
                    $zipcode = $rowData[9];
                    $customer_contact_name = $rowData[10];
                    $phone = $rowData[11];
                    $email = $rowData[12];
                    $line_id = $rowData[13];
                    $facebook = $rowData[14];

                    $modelx = new \backend\models\Customer();
                    // $modelx->code = $rowData[0];
                    $modelx->code = $rowData[0];//$modelx->getLastNo(1, 2);
                    $modelx->name = $customer_name;
                    $modelx->customer_group_id = $group_id;
                    $modelx->phone = '';// $rowData[10];
                    $modelx->email = '';// $rowData[10];
                    $modelx->status = 1;
                    $modelx->company_id = 1;


                    if ($modelx->save(false)) {

                        //update address
                        $district_id = $this->getDistrictId($rowData[6]);
                        $amphur_id = $this->getAmphurId($rowData[7]);
                        $province_id = $this->getProvinceId($rowData[8]);

                        $model_address_dup = \common\models\AddressInfo::find()->where(['party_type' => 2,'party_id' => $modelx->id])->one();
                        if($model_address_dup){
                            $model_address_dup->address = $rowData[4];
                            $model_address_dup->street = $rowData[5];
                            $model_address_dup->district_id = $district_id;
                            $model_address_dup->city_id = $amphur_id;
                            $model_address_dup->province_id = $province_id;
                            $model_address_dup->zipcode = $rowData[9];
                            $model_address_dup->status = 1;

                            if($model_address_dup->save(false)){

                            }

                        }else{
                            $model_address = new \common\models\Addressinfo();
                            $model_address->party_type = 2;
                            $model_address->party_id = $modelx->id;
                            $model_address->address = $rowData[4];
                            $model_address->street = $rowData[5];
                            $model_address->district_id = $district_id;
                            $model_address->city_id = $amphur_id;
                            $model_address->province_id = $province_id;
                            $model_address->zipcode = $rowData[9];
                            $model_address->status = 1;

                            if($model_address->save(false)){

                            }
                        }
                        //end update address

                        //update customer contact
//                        $district_id = $this->getDistrictId($rowData[6]);
//                        $amphur_id = $this->getAmphurId($rowData[7]);
//                        $province_id = $this->getProvinceId($rowData[8]);

                        $model_cus_contact_dup = \common\models\ContactInfo::find()->where(['contact_name' => $customer_contact_name,'party_id' => $modelx->id])->one();
                        if($model_cus_contact_dup){
                            $model_cus_contact_dup->contact_no = $phone;
                            $model_cus_contact_dup->contact_name = $customer_contact_name;
                            $model_cus_contact_dup->type_id = 1;
//                            $model_cus_contact_dup->status = 1;

                            if($model_cus_contact_dup->save(false)){

                            }

                        }else{
                            $model_cus_contact = new \common\models\ContactInfo();
                            $model_cus_contact->party_type = 1;
                            $model_cus_contact->party_id = $modelx->id;
                            $model_cus_contact->type_id = 1;
                            $model_cus_contact->contact_name = $customer_contact_name;
                            $model_cus_contact->contact_no = $phone;
//                            $model_cus_contact->status = 1;

                            if($model_cus_contact->save(false)){

                            }
                        }
                        //end update customer contact

                        $res += 1;
                    }
                }
                //    print_r($qty_text);return;

                if ($res > 0) {
                    $session = Yii::$app->session;
                    $session->setFlash('msg', 'นำเข้าข้อมูลเรียบร้อย');
                    return $this->redirect(['index']);
                } else {
                    $session = Yii::$app->session;
                    $session->setFlash('msg-error', 'พบข้อมผิดพลาดนะ');
                    return $this->redirect(['index']);
                }
                // }
                fclose($file);
//            }
//        }
            }
        }
    }


    public function actionImportcustomer2()
    {
        $uploaded = UploadedFile::getInstanceByName('file_customer');
        if (!empty($uploaded)) {
            //echo "ok";return;
            $upfiles = time() . "." . $uploaded->getExtension();
            // if ($uploaded->saveAs(Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles)) {
            if ($uploaded->saveAs('../web/uploads/files/customers/' . $upfiles)) {
                //  echo "okk";return;
                // $myfile = Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles;
                $myfile = '../web/uploads/files/customers/' . $upfiles;
                $file = fopen($myfile, "r+");
                fwrite($file, "\xEF\xBB\xBF");

                setlocale(LC_ALL, 'th_TH.TIS-620');
                $i = -1;
                $res = 0;
                $data = [];
                $loop = 0;
                while (($rowData = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $i += 1;
                    $catid = 0;
                    $qty = 0;
                    $price = 0;
                    $cost = 0;


                    if ($i == 0) {
                        continue;
                    }

                    $model_dup = \backend\models\Customer::find()->where(['name' => trim($rowData[3]), 'company_id' => 2])->one();
                    if ($model_dup != null) {
                        $loop++;
                        continue;
                    }

//                    $route_id = $this->checkRoute($rowData[3]);
               //     $group_id = $this->checkCustomergroup($rowData[2]);
//                    $type_id = $this->checkCustomertype($rowData[6]);
//                    $payment_method = $this->checkPaymethod($rowData[14]);
//                    $payment_term = $this->checkPayterm($rowData[15]);

                    $customer_name = $rowData[3];
                    $address = $rowData[4];
                    $phone = $rowData[13];
                    $email = $rowData[12];
                    $taxid = $rowData[8];
                    $branch_code = $rowData[9];
                    $branch_name = $rowData[10];

                    $modelx = new \backend\models\Customer();
                    // $modelx->code = $rowData[0];
                    $modelx->code = '';//$rowData[0];//$modelx->getLastNo(1, 2);
                    $modelx->name = $customer_name;
                  //  $modelx->customer_group_id = $group_id;
                    $modelx->phone = $phone;// $rowData[10];
                    $modelx->email = $email;// $rowData[10];
                    $modelx->status = 1;
                    $modelx->address = $address;
                    $modelx->taxid = $taxid;
                    $modelx->company_id = 2;
                    $modelx->branch_code = $branch_code;
                    $modelx->branch_name = $branch_name;


                    if ($modelx->save(false)) {

//                        //update address
//                        $district_id = $this->getDistrictId($rowData[6]);
//                        $amphur_id = $this->getAmphurId($rowData[7]);
//                        $province_id = $this->getProvinceId($rowData[8]);
//
//                        $model_address_dup = \common\models\AddressInfo::find()->where(['party_type' => 2,'party_id' => $modelx->id])->one();
//                        if($model_address_dup){
//                            $model_address_dup->address = $rowData[4];
//                            $model_address_dup->street = $rowData[5];
//                            $model_address_dup->district_id = $district_id;
//                            $model_address_dup->city_id = $amphur_id;
//                            $model_address_dup->province_id = $province_id;
//                            $model_address_dup->zipcode = $rowData[9];
//                            $model_address_dup->status = 1;
//
//                            if($model_address_dup->save(false)){
//
//                            }
//
//                        }else{
//                            $model_address = new \common\models\Addressinfo();
//                            $model_address->party_type = 2;
//                            $model_address->party_id = $modelx->id;
//                            $model_address->address = $rowData[4];
//                            $model_address->street = $rowData[5];
//                            $model_address->district_id = $district_id;
//                            $model_address->city_id = $amphur_id;
//                            $model_address->province_id = $province_id;
//                            $model_address->zipcode = $rowData[9];
//                            $model_address->status = 1;
//
//                            if($model_address->save(false)){
//
//                            }
//                        }
//                        //end update address
//
//                        //update customer contact
////                        $district_id = $this->getDistrictId($rowData[6]);
////                        $amphur_id = $this->getAmphurId($rowData[7]);
////                        $province_id = $this->getProvinceId($rowData[8]);
//
//                        $model_cus_contact_dup = \common\models\ContactInfo::find()->where(['contact_name' => $customer_contact_name,'party_id' => $modelx->id])->one();
//                        if($model_cus_contact_dup){
//                            $model_cus_contact_dup->contact_no = $phone;
//                            $model_cus_contact_dup->contact_name = $customer_contact_name;
//                            $model_cus_contact_dup->type_id = 1;
////                            $model_cus_contact_dup->status = 1;
//
//                            if($model_cus_contact_dup->save(false)){
//
//                            }
//
//                        }else{
//                            $model_cus_contact = new \common\models\ContactInfo();
//                            $model_cus_contact->party_type = 1;
//                            $model_cus_contact->party_id = $modelx->id;
//                            $model_cus_contact->type_id = 1;
//                            $model_cus_contact->contact_name = $customer_contact_name;
//                            $model_cus_contact->contact_no = $phone;
////                            $model_cus_contact->status = 1;
//
//                            if($model_cus_contact->save(false)){
//
//                            }
//                        }
//                        //end update customer contact

                        $res += 1;
                    }
                }
                //    print_r($qty_text);return;

                if ($res > 0) {
                    $session = Yii::$app->session;
                    $session->setFlash('msg', 'นำเข้าข้อมูลเรียบร้อย');
                    return $this->redirect(['index']);
                } else {
                    $session = Yii::$app->session;
                    $session->setFlash('msg-error', 'พบข้อมผิดพลาดนะ');
                    return $this->redirect(['index']);
                }
                // }
                fclose($file);
//            }
//        }
            }
        }
    }

    public function actionImportemployee()
    {
        $uploaded = UploadedFile::getInstanceByName('file_employee');
        if (!empty($uploaded)) {
            //echo "ok";return;
            $upfiles = time() . "." . $uploaded->getExtension();
            // if ($uploaded->saveAs(Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles)) {
            if ($uploaded->saveAs('../web/uploads/files/customers/' . $upfiles)) {
                //  echo "okk";return;
                // $myfile = Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles;
                $myfile = '../web/uploads/files/customers/' . $upfiles;
                $file = fopen($myfile, "r");
                fwrite($file, "\xEF\xBB\xBF");

                setlocale(LC_ALL, 'th_TH.TIS-620');
                $i = -1;
                $res = 0;
                $data = [];
                while (($rowData = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $i += 1;
                    $catid = 0;
                    $qty = 0;
                    $price = 0;
                    $cost = 0;
                    if ($rowData[2] == '' || $i == 0) {
                        continue;
                    }

                    $model_dup = \backend\models\Employee::find()->where(['fname' => trim($rowData[2])])->one();
                    if ($model_dup != null) {
                        continue;
                    }


                    $modelx = new \backend\models\Employee();
                    $modelx->code = $rowData[1];
                    $modelx->fname = $rowData[2];
                    $modelx->lname = $rowData[3];
                    $modelx->status = 1;
                    if ($modelx->save(false)) {
                        $res += 1;
                    }
                }
                //    print_r($qty_text);return;

                if ($res > 0) {
                    $session = Yii::$app->session;
                    $session->setFlash('msg', 'นำเข้าข้อมูลเรียบร้อย');
                    return $this->redirect(['index']);
                } else {
                    $session = Yii::$app->session;
                    $session->setFlash('msg-error', 'พบข้อมผิดพลาด');
                    return $this->redirect(['index']);
                }
                // }
                fclose($file);
//            }
//        }
            }
        }
    }

    public function checkRoute($name)
    {
        $id = 0;
        if ($name != '') {
            $model = \backend\models\Deliveryroute::find()->where(['code' => $name, 'company_id' => 1, 'branch_id' => 1])->one();
            if ($model) {
                $id = $model->id;
            } else {
                $model_new = new \backend\models\Deliveryroute();
                $model_new->code = $name;
                $model_new->name = $name;
                $model_new->description = $name;
                $model_new->company_id = 1;
                $model_new->branch_id = 1;
                // $model_new->status = 1;
                if ($model_new->save(false)) {
                    $id = $model_new->id;
                }
            }
        }
        return $id;
    }

    public function checkCustomergroup($name)
    {
        $id = 0;
        if ($name != '') {
            $model = \backend\models\Customergroup::find()->where(['name' => $name])->one();
            if ($model) {
                $id = $model->id;
            } else {
                $model_new = new \backend\models\Customergroup();
                $model_new->name = $name;
                $model_new->description = $name;
                $model_new->company_id = 1;
                $model_new->status = 1;
                if ($model_new->save()) {
                    $id = $model_new->id;
                }
            }
        }
        return $id;
    }

    public function checkCustomertype($name)
    {
        $id = 0;
        if ($name != '') {
            $model = \backend\models\Customertype::find()->where(['code' => $name, 'company_id' => 1, 'branch_id' => 1])->one();
            if ($model) {
                $id = $model->id;
            } else {
                $model_new = new \backend\models\Customertype();
                $model_new->code = $name;
                $model_new->name = $name;
                $model_new->description = $name;
                $model_new->status = 1;
                $model_new->company_id = 1;
                $model_new->branch_id = 1;
                if ($model_new->save(false)) {
                    $id = $model_new->id;
                }
            }
        }
        return $id;
    }

    public function checkPaymethod($name)
    {
        $id = 0;
        if ($name != '') {
            $model = \backend\models\Paymentmethod::find()->where(['code' => trim($name), 'company_id' => 1, 'branch_id' => 1])->one();
            if ($model) {
                $id = $model->id;
            } else {
                $model_new = new \backend\models\Paymentmethod();
                $model_new->code = $name;
                $model_new->name = $name;
                $model_new->note = $name;
                $model_new->status = 1;
                $model_new->company_id = 1;
                $model_new->branch_id = 1;
                if ($model_new->save()) {
                    $id = $model_new->id;
                }
            }
        }
        return $id;
    }

    public function checkPayterm($name)
    {
        $id = 0;
        if ($name != '') {
            $model = \backend\models\Paymentterm::find()->where(['code' => $name, 'company_id' => 1, 'branch_id' => 1])->one();
            if ($model) {
                $id = $model->id;
            } else {
                $model_new = new \backend\models\Paymentterm();
                $model_new->code = $name;
                $model_new->name = $name;
                $model_new->description = $name;
                $model_new->status = 1;
                $model_new->company_id = 1;
                $model_new->branch_id = 1;
                if ($model_new->save()) {
                    $id = $model_new->id;
                }
            }
        }
        return $id;
    }

    public function checkPricegroup($code, $name, $type_id)
    {
        $id = 0;
        if ($code != '') {
            $model = \backend\models\Pricegroup::find()->where(['code' => $code, 'company_id' => 1, 'branch_id' => 1])->one();
            if ($model) {
                $model_add_type = \common\models\PriceCustomerType::find()->where(['price_group_id' => $model->id, 'customer_type_id' => $type_id])->one();
                if (!$model_add_type) {
                    $add_model = new \common\models\PriceCustomerType();
                    $add_model->price_group_id = $model->id;
                    $add_model->customer_type_id = $type_id;
                    $add_model->status = 1;
                    $add_model->company_id = 1;
                    $add_model->branch_id = 1;
                    $add_model->save();
                }
            } else {
                $model_new = new \backend\models\Pricegroup();
                $model_new->code = $code;
                $model_new->name = $name;
                $model_new->description = $name;
                $model_new->status = 1;
                $model_new->company_id = 1;
                $model_new->branch_id = 2;
                if ($model_new->save()) {
                    $model_add_type = \common\models\PriceCustomerType::find()->where(['price_group_id' => $model_new->id, 'customer_type_id' => $type_id, 'company_id' => 1, 'branch_id' => 1])->one();
                    if (!$model_add_type) {
                        $add_model = new \common\models\PriceCustomerType();
                        $add_model->price_group_id = $model_new->id;
                        $add_model->customer_type_id = $type_id;
                        $add_model->status = 1;
                        $add_model->company_id = 1;
                        $add_model->branch_id = 1;
                        $add_model->save();
                    }
                }
            }
        }
        return $id;
    }


    public function actionProductgroupcopy()
    {
        $model = \backend\models\Productgroup::find()->where(['company_id' => 1, 'branch_id' => 1])->all();
        foreach ($model as $value) {
            $modelnew = new \backend\models\Productgroup();
            $modelnew->code = $value->code;
            $modelnew->description = $value->description;
            $modelnew->name = $value->name;
            $modelnew->status = $value->status;
            $modelnew->company_id = 1;
            $modelnew->branch_id = 1;
            $modelnew->save(false);
        }
    }

    public function actionProducttypecopy()
    {
        $model = \backend\models\Producttype::find()->where(['company_id' => 1, 'branch_id' => 1])->all();
        foreach ($model as $value) {
            $modelnew = new \backend\models\Producttype();
            $modelnew->code = $value->code;
            $modelnew->description = $value->description;
            $modelnew->name = $value->name;
            $modelnew->status = $value->status;
            $modelnew->company_id = 1;
            $modelnew->branch_id = 1;
            $modelnew->save(false);
        }
    }

    public function actionCartypecopy()
    {
        $model = \backend\models\Cartype::find()->where(['company_id' => 1, 'branch_id' => 1])->all();
        foreach ($model as $value) {
            $modelnew = new \backend\models\Cartype();
            $modelnew->code = $value->code;
            $modelnew->description = $value->description;
            $modelnew->name = $value->name;
            $modelnew->status = $value->status;
            $modelnew->company_id = 1;
            $modelnew->branch_id = 1;
            $modelnew->save(false);
        }
    }

    public function actionUnitcopy()
    {
        $model = \backend\models\Unit::find()->where(['company_id' => 1, 'branch_id' => 1])->all();
        foreach ($model as $value) {
            $modelnew = new \backend\models\Unit();
            $modelnew->code = $value->code;
            $modelnew->description = $value->description;
            $modelnew->name = $value->name;
            $modelnew->status = $value->status;
            $modelnew->company_id = 1;
            $modelnew->branch_id = 1;
            $modelnew->save(false);
        }
    }

    public function actionProductcopy()
    {
        $model = \backend\models\Product::find()->where(['company_id' => 1, 'branch_id' => 1])->all();
        foreach ($model as $value) {
            $modelnew = new \backend\models\Product();
            $modelnew->code = $value->code;
            $modelnew->description = $value->description;
            $modelnew->name = $value->name;
            $modelnew->product_group_id = $value->product_group_id;
            $modelnew->product_type_id = $value->product_type_id;
            $modelnew->photo = $value->photo;
            $modelnew->sale_price = $value->sale_price;
            $modelnew->std_cost = $value->std_cost;
            $modelnew->status = $value->status;
            $modelnew->company_id = 1;
            $modelnew->branch_id = 1;
            $modelnew->nw = $value->nw;
            $modelnew->sale_status = $value->sale_status;
            $modelnew->stock_type = $value->stock_type;
            $modelnew->is_pos_item = $value->is_pos_item;
            $modelnew->item_pos_seq = $value->item_pos_seq;
            $modelnew->unit_id = $value->unit_id;
            $modelnew->save(false);
        }
    }

    public function actionSeqcopy()
    {
        $model = \backend\models\Sequence::find()->where(['company_id' => 1, 'branch_id' => 1])->all();
        foreach ($model as $value) {
            $model_new = new \backend\models\Sequence();
            $model_new->plant_id = $value->plant_id;
            $model_new->module_id = $value->module_id;
            $model_new->prefix = $value->prefix;
            $model_new->symbol = $value->symbol;
            $model_new->use_year = $value->use_year;
            $model_new->use_month = $value->use_month;
            $model_new->use_day = $value->use_day;
            $model_new->minimum = $value->minimum;
            $model_new->maximum = $value->maximum;
            $model_new->currentnum = $value->currentnum;
            $model_new->status = $value->status;
            $model_new->company_id = 1;
            $model_new->branch_id = 1;
            $model_new->save();
        }
    }

    public function actionImportupdateorderpay()
    {
        $from_no = \Yii::$app->request->post('form_no');
        $to_no = \Yii::$app->request->post('to_no');
        $uploaded = UploadedFile::getInstanceByName('file_order_pay');
        if (!empty($uploaded)) {
            //echo "ok";return;
            $upfiles = time() . "." . $uploaded->getExtension();
            // if ($uploaded->saveAs(Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles)) {
            if ($uploaded->saveAs('../web/uploads/files/customers/' . $upfiles)) {
                //  echo "okk";return;
                // $myfile = Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles;
                $myfile = '../web/uploads/files/customers/' . $upfiles;
                $file = fopen($myfile, "r+");
                fwrite($file, "\xEF\xBB\xBF");

                setlocale(LC_ALL, 'th_TH.TIS-620');
                $i = -1;
                $res = 0;

                while (($rowData = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $i += 1;
                    if ($i == 0) {
                        continue;
                    }
                    if($i>=$from_no && $i <= $to_no){
                        $order_id = $rowData[2];
                        echo $order_id.'<br />';
                         \common\models\Orders::updateAll(['payment_status'=>1],['id'=>$order_id]);
                        $res += 1;
                    }else{
                        echo "finished";
                        return;
                    }


                    //if($res == 5000)return;
                }
                //    print_r($qty_text);return;

                if ($res > 0) {
                    $session = Yii::$app->session;
                    $session->setFlash('msg', 'นำเข้าข้อมูลเรียบร้อย');
                    return $this->redirect(['index']);
                } else {
                    $session = Yii::$app->session;
                    $session->setFlash('msg-error', 'พบข้อมผิดพลาดนะ');
                    return $this->redirect(['index']);
                }
                // }
                fclose($file);
//            }
//        }
            }
        }
    }

    public function getDistrictId($name)
    {
        $id = 0;
        if ($name != '') {
            $model = \backend\models\District::find()->where(['DISTRICT_NAME' => trim($name)])->one();
            if ($model) {
                $id = $model->DISTRICT_ID;
            }
        }
        return $id;
    }

    public function getAmphurId($name)
    {
        $id = 0;
        if ($name != '') {
            $model = \backend\models\Amphur::find()->where(['AMPHUR_NAME' => trim($name)])->one();
            if ($model) {
                $id = $model->AMPHUR_ID;
            }
        }
        return $id;
    }

    public function getProvinceId($name)
    {
        $id = 0;
        if ($name != '') {
            $model = \backend\models\Province::find()->where(['PROVINCE_NAME' => trim($name)])->one();
            if ($model) {
                $id = $model->PROVINCE_ID;
            }
        }
        return $id;
    }


}
