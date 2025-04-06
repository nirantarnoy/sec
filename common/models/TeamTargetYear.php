<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "team_target_year".
 *
 * @property int $id
 * @property int|null $target_year
 * @property int|null $team_id
 * @property float|null $target_amount
 */
class TeamTargetYear extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team_target_year';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['target_year', 'team_id'], 'integer'],
            [['target_amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'target_year' => 'Target Year',
            'team_id' => 'Team ID',
            'target_amount' => 'Target Amount',
        ];
    }
}
