<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workorder_line".
 *
 * @property int $id
 * @property int|null $workorder_id
 * @property string|null $description
 */
class WorkorderLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workorder_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workorder_id'], 'integer'],
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
            'workorder_id' => 'Workorder ID',
            'description' => 'Description',
        ];
    }
}
