<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "preinvoice".
 *
 * @property int $id
 * @property string|null $journal_no
 * @property string|null $journal_date
 * @property string|null $name
 * @property string|null $description
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Preinvoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preinvoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['journal_date'], 'safe'],
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by','customer_id'], 'integer'],
            [['journal_no', 'name', 'description'], 'string', 'max' => 255],
            [['total_amount'],'number'],
            [['from_date','to_date'],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_no' => 'เลขที่',
            'journal_date' => 'วันที่',
            'name' => 'รายละเอียด',
            'description' => 'Description',
            'customer_id' => 'ลูกค้า',
            'status' => 'Status',
            'total_amount'=>'ยอดเงินรวม',
            'from_date'=>'ตั้งแต่วันที่',
            'to_date' => 'ถึงวันที่',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
