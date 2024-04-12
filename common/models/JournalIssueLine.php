<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "journal_issue_line".
 *
 * @property int $id
 * @property int|null $journal_issue_id
 * @property int|null $product_id
 * @property float|null $qry
 * @property int|null $status
 * @property string|null $reason
 */
class JournalIssueLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal_issue_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['journal_issue_id', 'product_id', 'status','warehouse_id'], 'integer'],
            [['qry'], 'number'],
            [['reason'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_issue_id' => 'Journal Issue ID',
            'product_id' => 'Product ID',
            'qry' => 'Qry',
            'status' => 'Status',
            'reason' => 'Reason',
        ];
    }
}
