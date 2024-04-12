<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "journal_issue".
 *
 * @property int $id
 * @property string|null $journal_no
 * @property string|null $trans_date
 * @property int|null $department_id
 * @property string|null $reason
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class JournalIssue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal_issue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date'], 'safe'],
            [['department_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by','trans_ref_id'], 'integer'],
            [['journal_no', 'reason'], 'string', 'max' => 255],
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
            'trans_date' => 'วันที่',
            'department_id' => 'แผนก',
            'reason' => 'เหตุผล',
            'status' => 'สถานะ',
            'trans_ref_id' => 'อ้างอิงใบแจ้งซ่อม',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
