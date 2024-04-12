<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer_assign_list".
 *
 * @property int $id
 * @property int|null $customer_id
 * @property int|null $group_id
 */
class CustomerAssignList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_assign_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'group_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'group_id' => 'Group ID',
        ];
    }
}
