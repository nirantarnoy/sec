<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%customer}}`.
 */
class m240413_020101_add_payment_term_id_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer}}', 'payment_term_id', $this->integer());
        $this->addColumn('{{%customer}}', 'payment_method_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%customer}}', 'payment_term_id');
        $this->dropColumn('{{%customer}}', 'payment_method_id');
    }
}
