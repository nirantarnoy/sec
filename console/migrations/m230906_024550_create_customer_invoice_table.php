<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer_invoice}}`.
 */
class m230906_024550_create_customer_invoice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer_invoice}}', [
            'id' => $this->primaryKey(),
            'invoice_no' => $this->string(),
            'invoice_date' => $this->datetime(),
            'invoice_target_date' => $this->datetime(),
            'sale_id' => $this->integer(),
            'work_name' => $this->string(),
            'customer_id' => $this->integer(),
            'total_amount' => $this->float(),
            'vat_amount' => $this->float(),
            'vat_per' => $this->float(),
            'total_all_amount' => $this->float(),
            'total_text' => $this->string(),
            'remark' => $this->string(),
            'remark2' => $this->string(),
            'create_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'status' => $this->integer(),
            'customer_extend_remark' => $this->string(),
            'company_extend_remark' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customer_invoice}}');
    }
}
