<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kpi_performance".
 *
 * @property int $id
 * @property string|null $trans_date
 * @property int|null $team_id
 * @property float|null $rating_per
 * @property float|null $personal_goal_per
 * @property float|null $high_performance_per
 * @property float|null $minimum_per
 * @property float|null $low_performance_per
 */
class KpiPerformance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kpi_performance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date'], 'safe'],
            [['team_id'], 'integer'],
            [['rating_per', 'personal_goal_per', 'high_performance_per', 'minimum_per', 'low_performance_per'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trans_date' => 'Trans Date',
            'team_id' => 'Team ID',
            'rating_per' => 'Rating Per',
            'personal_goal_per' => 'Personal Goal Per',
            'high_performance_per' => 'High Performance Per',
            'minimum_per' => 'Minimum Per',
            'low_performance_per' => 'Low Performance Per',
        ];
    }
}
