<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "work_queue_item_line".
 *
 * @property int $id
 * @property int|null $work_queue_id
 * @property int|null $item_id
 * @property string|null $description
 * @property int|null $status
 */
class WorkQueueItemLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_queue_item_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['work_queue_id', 'item_id', 'status'], 'integer'],
            [['description'], 'string', 'max' => 255],
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
            'item_id' => 'ของนำกลับ',
            'description' => 'รายละเอียด',
            'status' => 'สถานะ',
        ];
    }
}
