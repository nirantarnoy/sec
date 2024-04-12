<?php

namespace backend\controllers;

use backend\models\Fueldailyprice;
use backend\models\FueldailypriceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FueldailypriceController implements the CRUD actions for Fueldailyprice model.
 */
class FueldailypriceController extends Controller
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
     * Lists all Fueldailyprice models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $model_max_date = \backend\models\Fueldailyprice::find()->max('price_date');

        $searchModel = new FueldailypriceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andFilterWhere(['date(price_date)'=>date('Y-m-d',strtotime($model_max_date))]);
        $dataProvider->query->orderBy(['province_id'=>SORT_ASC,'price_date'=>SORT_DESC]);

        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Fueldailyprice model.
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
     * Creates a new Fueldailyprice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Fueldailyprice();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $line_fuel_id = \Yii::$app->request->post('line_fuel_id');
                $line_fuel_price = \Yii::$app->request->post('line_fuel_price');
                $line_fuel_price_add = \Yii::$app->request->post('line_fuel_price_add');
                $line_fuel_price_total = \Yii::$app->request->post('line_fuel_price_total');

                $car_type_id = \Yii::$app->request->post('car_type_id');
                $province_id = \Yii::$app->request->post('province_id');
                $city_id = \Yii::$app->request->post('city_id');

                $res = 0;

                $price_date = $model->price_date;
                //explode ตามขั้นตอน
                $new_price_date = date('Y-m-d');
                $x_date = explode('/', $price_date);
                if (count($x_date) > 1) {
                    $new_price_date = $x_date[2] . '/' . $x_date[0] . '/' . $x_date[1];
                }
//                print_r($new_price_date); return ;

                if($line_fuel_id != null){
                    for($x=0;$x<=count($line_fuel_id)-1;$x++){
                        $model_x = new \backend\models\Fueldailyprice();
                        $model_x->province_id = $province_id;
                        $model_x->city_id = $city_id;
                        $model_x->fuel_id= $line_fuel_id[$x];
                        $model_x->price_date = date('Y-m-d H:i:s',strtotime($new_price_date));
                        $model_x->price_origin = $line_fuel_price[$x];
                        $model_x->price_add = $line_fuel_price_add[$x];
                        $model_x->price = $line_fuel_price_total[$x];
                        $model_x->status = 1;
                        $model_x->car_type_id = $car_type_id;
                        if($model_x->save(false)){
                            $res+=1;
                        }
                    }
                }

                  if($res > 0){
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
     * Updates an existing Fueldailyprice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line = null;


        if($model){
            $province_id = $model->province_id;
            $price_date = $model->price_date;
            $model_line = \backend\models\Fueldailyprice::find()->where(['province_id'=>$province_id])->andFilterWhere(['date(price_date)'=>date('Y-m-d',strtotime($price_date))])->all();
        }

        if ($this->request->isPost && $model->load($this->request->post())) {

            $line_fuel_id = \Yii::$app->request->post('line_fuel_id');
            $line_fuel_price = \Yii::$app->request->post('line_fuel_price');
            $line_fuel_price_add = \Yii::$app->request->post('line_fuel_price_add');
            $line_fuel_price_total = \Yii::$app->request->post('line_fuel_price_total');

            $car_type_id = \Yii::$app->request->post('car_type_id');
            $province_id = \Yii::$app->request->post('province_id');
            $city_id = \Yii::$app->request->post('city_id');

            $res = 0;

            $price_date1 = $model->price_date;
            //explode ตามขั้นตอน
            $new_price_date = date('Y-m-d');
            $x_date = explode('/', $price_date1);
            if (count($x_date) > 1) {
                $new_price_date = $x_date[2] . '/' . $x_date[0] . '/' . $x_date[1];
            }
//                print_r($line_fuel_id); return ;

            if($line_fuel_id != null){
                $price_date2 = $model->price_date;
                for($x=0;$x<=count($line_fuel_id)-1;$x++){
                    $model_x_chk = \backend\models\Fueldailyprice::find()->where(['fuel_id'=>$line_fuel_id[$x],'province_id'=>$province_id,'city_id'=>$city_id])->andFilterWhere(['date(price_date)'=>date('Y-m-d',strtotime($price_date2))])->one();
                    if ($model_x_chk){
                        $model_x_chk->province_id = $province_id;
                        $model_x_chk->city_id = $city_id;
                        $model_x_chk->fuel_id = $line_fuel_id[$x];
                        $model_x_chk->price_date = date('Y-m-d H:i:s',strtotime($new_price_date));
                        $model_x_chk->price_origin = $line_fuel_price[$x];
                        $model_x_chk->price_add = $line_fuel_price_add[$x];
                        $model_x_chk->price = $line_fuel_price_total[$x];
                        $model_x_chk->status = 1;
                        $model_x_chk->car_type_id = $car_type_id;
                        if ($model_x_chk->save(false)){

                        }
                    }else{
                        $model_x = new \backend\models\Fueldailyprice();
                        $model_x->province_id = $province_id;
                        $model_x->city_id = $city_id;
                        $model_x->fuel_id= $line_fuel_id[$x];
                        $model_x->price_date = date('Y-m-d H:i:s',strtotime($new_price_date));
                        $model_x->price_origin = $line_fuel_price[$x];
                        $model_x->price_add = $line_fuel_price_add[$x];
                        $model_x->price = $line_fuel_price_total[$x];
                        $model_x->status = 1;
                        $model_x->car_type_id = $car_type_id;
                        if($model_x->save(false)){
                            $res+=1;
                        }
                    }
                }
            }

            if($res > 0){
                return $this->redirect(['index']);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line
        ]);
    }

    /**
     * Deletes an existing Fueldailyprice model.
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
     * Finds the Fueldailyprice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Fueldailyprice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fueldailyprice::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetapiprice(){
        $html = '';

        $model = \common\models\FuelPrice::find()->where(['date(price_date)'=>date('Y-m-d')])->all();
        if($model){
            foreach($model as $value){
                $oil_id = $value->fuel_id;
                $oil_name = \backend\models\Fuel::findName($value->fuel_id);
                $price = $value->price;

                $html.='<tr>';
                $html.='<td> <input type="hidden" name="line_fuel_id[]" class="form-control line-fuel-id" value="'.$oil_id.'" />'.$oil_name;
                $html.='</td>';
                $html.='<td> <input style="text-align: right;" type="text" name="line_fuel_price[]" class="form-control line-fuel-price" readonly value="'.$price.'" />';
                $html.='</td>';
                $html.='<td><input style="text-align: right;" type="text" name="line_fuel_price_add[]" class="form-control line-fuel-price-add" value="0" onchange="getPrice($(this))" />';
                $html.='</td>';
                $html.='<td><input style="text-align: right;" type="text" name="line_fuel_price_total[]" class="form-control line-fuel-price-total" readonly value="0" />';
                $html.='</td>';
                $html.='<td>';
                $html.='</td>';
                $html.='</tr>';
            }
        }

        echo $html;
    }
    public function actionUpdateall(){
        $model_max_date = \backend\models\Fueldailyprice::find()->max('price_date');
        if($model_max_date != null){
            $model = \backend\models\Fueldailyprice::find()->where(['date(price_date)'=>date('Y-m-d',strtotime($model_max_date))])->orderBy(['province_id'=>SORT_ASC])->all();
            if($model){
                foreach ($model as $value){
                    $model_check = \backend\models\Fueldailyprice::find()->where(['province_id'=>$value->province_id,'city_id'=>$value->city_id,'fuel_id'=>$value->fuel_id,'date(price_date)'=>date('Y-m-d')])->one();
                    if($model_check){
                        $model_check->car_type_id =  $value->car_type_id;
                        $model_check->save(false);
                    }else{
                        $current_price = $this->getCurrentPrice($value->fuel_id,0,0);
                        $model_new = new \backend\models\Fueldailyprice();
                        $model_new->fuel_id = $value->fuel_id;
                        $model_new->province_id = $value->province_id;
                        $model_new->city_id = $value->city_id;
                        $model_new->car_type_id = $value->car_type_id;
                        $model_new->price_origin = $current_price;
                        $model_new->price = ($current_price + 1);
                        $model_new->price_date = date('Y-m-d');
                        $model_new->status = 1;
                        $model_new->save(false);
                    }

                }
            }
        }
        \Yii::$app->session->setFlash('success',"ทำรายการเรียบร้อยแล้ว");
        return $this->redirect(['fueldailyprice/index']);

    }
    public function getCurrentPrice($fuel_id,$province_id,$city_id){
        $price = 0;
        $model = \common\models\FuelPrice::find()->where(['fuel_id'=>$fuel_id])->orderBy(['price_date'=>SORT_DESC])->one();
        if($model){
            $price = ($model->price); // add 1 bath
        }
        return $price;
    }
}
