<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "team_target".
 *
 * @property int $id
 * @property int|null $target_year_id
 * @property string|null $milestone
 * @property float|null $monthly_amount
 * @property float|null $tele_sell_amount
 * @property float|null $installation_amount
 * @property float|null $ttar_per
 */
class TeamTarget extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team_target';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['target_year_id'], 'integer'],
            [['monthly_amount', 'tele_sell_amount', 'installation_amount', 'ttar_per'], 'number'],
            [['milestone'], 'string', 'max' => 255],
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
            'milestone' => 'Milestone',
            'monthly_amount' => 'Monthly Amount',
            'tele_sell_amount' => 'Tele Sell Amount',
            'installation_amount' => 'Installation Amount',
            'ttar_per' => 'Ttar Per',
        ];
    }
}
