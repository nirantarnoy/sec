<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%job_line}}`.
 */
class m250221_041309_create_job_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%job_line}}', [
            'id' => $this->primaryKey(),
            'job_id' => $this->integer(),
            'product_id' => $this->integer(),
            'product_name' => $this->string(),
            'cost_per_unit' => $this->float(),
            'discount_per' => $this->float(),
            'dealer_price' => $this->float(),
            'vat_amount' => $this->float(),
            'total_cost_per_unit' => $this->float(),
            'qty' => $this->float(),
            'cost_total' => $this->float(),
            'quotation_per_unit_price' => $this->float(),
            'total_quotation_price' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%job_line}}');
    }
}
