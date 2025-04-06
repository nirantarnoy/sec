<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job_com_share".
 *
 * @property int $id
 * @property int|null $job_id
 * @property int|null $emp_id
 * @property float|null $share_per
 * @property float|null $share_amount
 * @property float|null $ttar_amount
 * @property float|null $ptar_amount
 * @property float|null $ppr_amount
 * @property float|null $total_amount
 * @property float|null $rebate_amount
 * @property float|null $grand_total
 */
class JobComShare extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_com_share';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'emp_id'], 'integer'],
            [['share_per', 'share_amount', 'ttar_amount', 'ptar_amount', 'ppr_amount', 'total_amount', 'rebate_amount', 'grand_total'], 'number'],
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
            'share_per' => 'Share Per',
            'share_amount' => 'Share Amount',
            'ttar_amount' => 'Ttar Amount',
            'ptar_amount' => 'Ptar Amount',
            'ppr_amount' => 'Ppr Amount',
            'total_amount' => 'Total Amount',
            'rebate_amount' => 'Rebate Amount',
            'grand_total' => 'Grand Total',
        ];
    }
}
