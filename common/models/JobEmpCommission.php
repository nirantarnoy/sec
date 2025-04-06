<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job_emp_commission".
 *
 * @property int $id
 * @property int|null $job_id
 * @property int|null $emp_id
 * @property float|null $commistion_per
 * @property float|null $commission_std_amount
 * @property float|null $ttar_amount
 * @property float|null $ptar_amount
 * @property float|null $ppr_amount
 * @property float|null $total_commission_amount
 * @property float|null $rebate_campaign_amount
 * @property float|null $grand_total_commision
 */
class JobEmpCommission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_emp_commission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'emp_id'], 'integer'],
            [['commistion_per', 'commission_std_amount', 'ttar_amount', 'ptar_amount', 'ppr_amount', 'total_commission_amount', 'rebate_campaign_amount', 'grand_total_commision'], 'number'],
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
            'emp_id' => 'Emp ID',
            'commistion_per' => 'Commistion Per',
            'commission_std_amount' => 'Commission Std Amount',
            'ttar_amount' => 'Ttar Amount',
            'ptar_amount' => 'Ptar Amount',
            'ppr_amount' => 'Ppr Amount',
            'total_commission_amount' => 'Total Commission Amount',
            'rebate_campaign_amount' => 'Rebate Campaign Amount',
            'grand_total_commision' => 'Grand Total Commision',
        ];
    }
}
