<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quotation}}`.
 */
class m241112_132112_add_discount_per_column_to_quotation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation}}', 'discount_per', $this->float());
        $this->addColumn('{{%quotation}}', 'discount_amt', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation}}', 'discount_per');
        $this->dropColumn('{{%quotation}}', 'discount_amt');
    }
}
