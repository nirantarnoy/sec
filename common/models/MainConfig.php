<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "main_config".
 *
 * @property int $id
 * @property int|null $is_cal_commission
 * @property float|null $commission_per
 * @property float|null $job_vat_per
 * @property float|null $withholding_per
 */
class MainConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'main_config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_cal_commission'], 'integer'],
            [['commission_per', 'job_vat_per', 'withholding_per'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_cal_commission' => 'คำนวนค่าคอมมิชชั่น',
            'commission_per' => 'ค่าคอมมิชชั่น (%)',
            'job_vat_per' => 'อัตรา VAT (%)',
            'withholding_per' => 'อัตรา หัก ณ ที่จ่าย (%)',
        ];
    }
}
