<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "journal_trans".
 *
 * @property int $id
 * @property string|null $journal_no
 * @property int|null $trans_type
 * @property int|null $company_id
 * @property int|null $create_at
 * @property int|null $created_by
 * @property int|null $status
 */
class JournalTrans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal_trans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_type', 'company_id', 'create_at', 'created_by', 'status'], 'integer'],
            [['journal_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_no' => 'Journal No',
            'trans_type' => 'Trans Type',
            'company_id' => 'Company ID',
            'create_at' => 'Create At',
            'created_by' => 'Created By',
            'status' => 'Status',
        ];
    }
}
