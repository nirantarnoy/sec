<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job_profit_com_std".
 *
 * @property int $id
 * @property int|null $job_id
 * @property float|null $std_amount
 * @property float|null $commission_per
 * @property float|null $commission_amount
 */
class JobProfitComStd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_profit_com_std';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id'], 'integer'],
            [['std_amount', 'commission_per', 'commission_amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_id' => 'Job ID',
            'std_amount' => 'Std Amount',
            'commission_per' => 'Commission Per',
            'commission_amount' => 'Commission Amount',
        ];
    }
}
