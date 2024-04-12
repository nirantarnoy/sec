<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "preinvoice_line".
 *
 * @property int $id
 * @property int|null $preinvoice_id
 * @property int|null $work_queue_id
 * @property float|null $total_amount
 * @property int|null $status
 */
class PreinvoiceLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preinvoice_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['preinvoice_id', 'work_queue_id', 'status'], 'integer'],
            [['total_amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'preinvoice_id' => 'Preinvoice ID',
            'work_queue_id' => 'Work Queue ID',
            'total_amount' => 'Total Amount',
            'status' => 'Status',
        ];
    }
}
