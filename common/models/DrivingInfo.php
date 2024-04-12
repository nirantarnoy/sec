<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "driving_info".
 *
 * @property int $id
 * @property int|null $emp_id
 * @property string|null $card_no
 * @property int|null $card_type
 * @property string|null $card_issue_date
 * @property string|null $card_expire_date
 * @property int|null $status
 */
class DrivingInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'driving_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_id', 'card_type', 'status'], 'integer'],
            [['card_issue_date', 'card_expire_date'], 'safe'],
            [['card_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'emp_id' => 'Emp ID',
            'card_no' => 'Card No',
            'card_type' => 'Card Type',
            'card_issue_date' => 'Card Issue Date',
            'card_expire_date' => 'Card Expire Date',
            'status' => 'Status',
        ];
    }
}
