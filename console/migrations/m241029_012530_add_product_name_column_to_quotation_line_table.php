<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quotation_line}}`.
 */
class m241029_012530_add_product_name_column_to_quotation_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation_line}}', 'product_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation_line}}', 'product_name');
    }
}
