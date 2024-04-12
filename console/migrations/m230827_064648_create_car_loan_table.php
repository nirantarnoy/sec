<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%car_loan}}`.
 */
class m230827_064648_create_car_loan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_loan}}', [
            'id' => $this->primaryKey(),
            'car_id' => $this->integer(),
            'total_period' => $this->integer(),
            'period_amount' => $this->float(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_loan}}');
    }
}
