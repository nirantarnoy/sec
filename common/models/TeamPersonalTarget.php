<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "team_personal_target".
 *
 * @property int $id
 * @property int|null $target_year_id
 * @property int|null $team_target_id
 * @property int|null $emp_id
 * @property float|null $emp_target_amount
 * @property float|null $ptar_per
 */
class TeamPersonalTarget extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team_personal_target';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['target_year_id', 'team_target_id', 'emp_id'], 'integer'],
            [['emp_target_amount', 'ptar_per'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'target_year_id' => 'Target Year ID',
            'team_target_id' => 'Team Target ID',
            'emp_id' => 'Emp ID',
            'emp_target_amount' => 'Emp Target Amount',
            'ptar_per' => 'Ptar Per',
        ];
    }
}
