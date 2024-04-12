<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%car_loan}}`.
 */
class m230827_064839_create_car_loan_trans_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_loan_trans}}', [
            'id' => $this->primaryKey(),
            'car_loan_id' => $this->integer(),
            'trans_date' => $this->datetime(),
            'period_no' => $this->integer(),
            'loan_pay_amt' => $this->float(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_loan_trans}}');
    }
}
