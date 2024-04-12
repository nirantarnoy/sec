<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fuel_issue}}`.
 */
class m221212_122658_create_fuel_issue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fuel_issue}}', [
            'id' => $this->primaryKey(),
            'journal_no' => $this->string(),
            'trans_date' => $this->datetime(),
            'compnay_id' => $this->integer(),
            'car_id' => $this->integer(),
            'head_no' => $this->string(),
            'tail_no' => $this->string(),
            'emp_id' => $this->integer(),
            'route_id' => $this->integer(),
            'weight_out' => $this->float(),
            'reduce_out' => $this->float(),
            'reason_out' => $this->string(),
            'parcel_back' => $this->string(),
            'weight_back' => $this->float(),
            'fuel_rate' => $this->float(),
            'reduce_back' => $this->float(),
            'reason_back' => $this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%fuel_issue}}');
    }
}
