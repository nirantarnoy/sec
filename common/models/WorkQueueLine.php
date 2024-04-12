<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "work_queue_line".
 *
 * @property int $id
 * @property int|null $work_queue_id
 * @property string|null $doc
 * @property int|null $status
 */
class WorkQueueLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_queue_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['work_queue_id', 'status'], 'integer'],
            [['doc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'work_queue_id' => 'Work Queue ID',
            'doc' => 'Doc',
            'status' => 'Status',
        ];
    }
}
