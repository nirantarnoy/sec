<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Company extends \common\models\Company
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by','show_expired_date'], 'integer'],
            [['name', 'description','doc','address'], 'string', 'max' => 255],
            [['taxid'], 'string', 'max' => 13],
            [['social_deduct_per'],'number'],
            [['social_base_price'],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ',
            'description' => 'รายละเอียด',
            'social_deduct_per'=>'อัตราหักประกันสังคม (%)',
            'social_base_price'=>'ฐานเงินเดือนประกันสังคม',
            'status' => 'สถานะ',
            'doc' => 'เอกสารแนบ',
            'taxid' => 'เลขที่ผู้เสียภาษี',
            'show_expired_date' => 'แสดงวันที่สินค้าหมดอายุ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    public static function findCompanyName($id)
    {
        $model = Company::find()->where(['id' => $id])->one();
        return $model != null ? $model->name : '';
    }
    public static function enableshowexpiredate()
    {
        $model = Company::find()->one();
        return $model != null ? $model->show_expired_date : 0;
    }
    public static function findAddress($id)
    {
        $model = Company::find()->where(['id' => $id])->one();
        return $model != null ? $model->address : '';
    }
    public static function findSocialbasePrice($id)
    {
        $model = Company::find()->where(['id' => $id])->one();
        return $model != null ? $model->social_base_price : 0;
    }
    public static function findTaxid($id){
        $model = Company::find()->where(['id' => $id])->one();
        return $model != null ? $model->taxid : '';
    }

    public static function findCompanySocialPer($id)
    {
        $per = 0;
        $model = \common\models\SocialPerTrans::find()->where(['company_id' => $id,'month(trans_date)'=>date('m'),'year(trans_date)'=>date('Y')])->one();
        if($model != null){
            if($model->social_per != null){
                $per = $model->social_per;
            }
        }
        return $per;
//        $per = 0;
//        $model = Company::find()->where(['id' => $id])->one();
//        if($model != null){
//            if($model->social_deduct_per != null){
//             $per = $model->social_deduct_per;
//            }
//        }
//        return $per;
    }

    public static function findSocialLastUpdate($id){
        $per_date = '';
        $model = \common\models\SocialPerTrans::find()->where(['company_id' => $id,'month(trans_date)'=>date('m'),'year(trans_date)'=>date('Y')])->one();
        if($model != null){
            if($model->trans_date != null){
                $per_date = date('d-m-Y H:i:s',strtotime($model->trans_date));
            }
        }
        return $per_date;
    }
}
