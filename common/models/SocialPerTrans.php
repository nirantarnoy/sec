<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "social_per_trans".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $trans_date
 * @property float|null $social_per
 */
class SocialPerTrans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'social_per_trans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id'], 'integer'],
            [['trans_date'], 'safe'],
            [['social_per'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'trans_date' => 'Trans Date',
            'social_per' => 'Social Per',
        ];
    }
}
