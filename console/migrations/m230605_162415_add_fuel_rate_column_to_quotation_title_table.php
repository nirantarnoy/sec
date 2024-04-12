<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quotation_title}}`.
 */
class m230605_162415_add_fuel_rate_column_to_quotation_title_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation_title}}', 'fuel_rate', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation_title}}', 'fuel_rate');
    }
}
