<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "team_line".
 *
 * @property int $id
 * @property int|null $team_id
 * @property int|null $emp_id
 * @property int|null $is_head
 * @property int|null $status
 */
class TeamLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['team_id', 'emp_id', 'is_head', 'status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team_id' => 'Team ID',
            'emp_id' => 'Emp ID',
            'is_head' => 'Is Head',
            'status' => 'Status',
        ];
    }
}
