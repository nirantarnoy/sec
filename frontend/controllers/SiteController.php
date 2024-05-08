<?php

namespace frontend\controllers;

use backend\models\ItemSearch;
use frontend\models\ProductSearch;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\Pagination;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $product_cat_search = \Yii::$app->request->get('product_cat_search');
        $product_search = \Yii::$app->request->get('product_search');
        $query = \backend\models\Product::find()->where(['status' => 1]);
        if (!empty($product_cat_search)) {
            $query->andFilterWhere(['product_group_id' => $product_cat_search]);
        }
        if (!empty($product_search)) {
            $query->andFilterWhere(['like', 'name', $product_search]);
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 18]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', [
            'model' => $model,
            'pages' => $pages,
            'product_cat_search' => $product_cat_search,
            'product_search' => $product_search,
        ]);
    }

    public function actionYourcart()
    {

        return $this->render('_cart');
    }

    public function actionProfile($id)
    {
        $model = null;
        if ($id) {
            $model = \backend\models\Customer::find()->where(['id' => $id])->one();
        } else {
            $model = new \backend\models\Customer();
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save(false)) {
                return $this->redirect(['profile', 'id' => $model->id]);
            }
        }
        return $this->render('_account', [
            'model' => $model,
        ]);
    }

    public function actionAddressinfo($id)
    {
        $model = null;
        $party_id = 0;
        if ($id) {
            $party_id = $id;
            $model = \backend\models\AddressInfo::find()->where(['party_id' => $id, 'party_type_id' => 2])->one();
            if (!$model) {
                $model = new \backend\models\AddressInfo();
            }
        } else {
            $model = new \backend\models\AddressInfo();
        }
        if ($model->load(\Yii::$app->request->post())) {
            $model->party_type_id = 2;
            $model->status = 1;
            if ($model->save(false)) {
                return $this->redirect(['addressinfo', 'id' => $model->party_id]);
            }
        }
        return $this->render('_address', [
            'model' => $model,
            'party_id' => $party_id,
        ]);
    }

    public function actionMyorder($id)
    {
        $model = null;
        $party_id = 0;
        if ($id) {
            $party_id = $id;
            $model = \backend\models\Order::find()->where(['customer_id' => $id])->one();
        }
        return $this->render('_myorder', [
            'model' => $model,
            'party_id' => $party_id,
        ]);
    }

    public function actionProductdetail($id)
    {
        if ($id) {
            $model = \backend\models\Product::find()->where(['id' => $id])->one();
        }
        return $this->render('_productdetail', [
            'model' => $model
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'ขอบคุณสำหรับการลงทะเบียน. กรุณายืนยันการลงทะเบียนผ่านทาง Inbox อีเมลของคุณ.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
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

    public function actionAddcart()
    {
        $product_id = \Yii::$app->request->post('product_id');
        $product_name = \Yii::$app->request->post('product_name');
        $qty = \Yii::$app->request->post('qty');
        $price = \Yii::$app->request->post('price');
        $sku = \Yii::$app->request->post('sku');
        $photo = \Yii::$app->request->post('photo');

        if ($product_id) {
            //if (isset($_POST['add_to_cart'])) {
                if (isset($_SESSION['cart'])) {
                    $session_array_id = array_column($_SESSION['cart'], 'product_id');
                    print_r($session_array_id);
                    if (!in_array($product_id, $session_array_id)) {
                        $session_array = array(
                            'product_id' => $product_id,
                            'sku' => $sku,
                            'product_name' =>  $product_name, // $_POST['name'],
                            'price' => $price, //$_POST['price'],
                            'qty' => (float)$qty, //$_POST['qty']
                            'photo' => $photo, //$_POST['qty']
                        );
                      //  echo 1;
                        $_SESSION['cart'][] = $session_array;
                    }else{
                        $index = array_search($product_id,$session_array_id);
       //                 if (in_array($product_id, $session_array_id)) {
                            $_SESSION['cart'][$index]['qty'] =$qty;
//                            $_SESSION['cart'][$product_id]['total'] = $qty;
      //                  }
//                        $session_array = array(
//                            "product_id" => $product_id,
//                            "product_name" =>  $product_name, // $_POST['name'],
//                            "price" => $price, //$_POST['price'],
//                            "qty" => $qty, //$_POST['qty']
//                        );

//                        $_SESSION['cart'][] = $session_array;
                      //  echo 100;
                    }

                } else {
                    $session_array = array(
                        'product_id' => $product_id,
                        'sku' => $sku,
                        'product_name' =>  $product_name, // $_POST['name'],
                        'price' => $price, //$_POST['price'],
                        'qty' => (float)$qty, //$_POST['qty']
                        'photo' => $photo,
                    );
                  //  echo 2;
                    $_SESSION['cart'][] = $session_array;
                }
            //}
        }
         return $this->redirect(['site/index']);
    }

    public function actionUpdatecart()
    {
        $product_id = \Yii::$app->request->post('product_id');
        $qty = \Yii::$app->request->post('qty');

        if ($product_id) {
            if (isset($_SESSION['cart'])) {
                $session_array_id = array_column($_SESSION['cart'], 'product_id');
                if (in_array($product_id, $session_array_id)) {
                    $index = array_search($product_id,$session_array_id);
                    $_SESSION['cart'][$index]['qty'] = $qty;
                }
            }
            echo "success";
        }
    }
    public function actionRemovecart()
    {
        $product_id = \Yii::$app->request->post('product_id');
        if ($product_id) {
            if (isset($_SESSION['cart'])) {
                $session_array_id = array_column($_SESSION['cart'], 'product_id');
                if (in_array($product_id, $session_array_id)) {
                    $index = array_search($product_id,$session_array_id);
                    unset($_SESSION['cart'][$index]);
                }
            }
            echo "success";
        }
    }

    public function actionCreateorder(){
        
    }
}
