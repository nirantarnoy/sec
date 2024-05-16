<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%customer_product_price}}`.
 */
class m240516_060237_add_include_vat_column_to_customer_product_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer_product_price}}', 'include_vat', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%customer_product_price}}', 'include_vat');
    }
}
