<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%customer}}`.
 */
class m250225_133256_add_phone_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer}}', 'phone', $this->string());
        $this->addColumn('{{%customer}}', 'email', $this->string());
        $this->addColumn('{{%customer}}', 'payment_term_id', $this->integer());
        $this->addColumn('{{%customer}}', 'payment_method_id', $this->integer());
        $this->addColumn('{{%customer}}', 'address', $this->string());
        $this->addColumn('{{%customer}}', 'vat_per_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%customer}}', 'phone');
        $this->dropColumn('{{%customer}}', 'email');
        $this->dropColumn('{{%customer}}', 'payment_term_id');
        $this->dropColumn('{{%customer}}', 'payment_method_id');
        $this->dropColumn('{{%customer}}', 'address');
        $this->dropColumn('{{%customer}}', 'vat_per_id');
    }
}
