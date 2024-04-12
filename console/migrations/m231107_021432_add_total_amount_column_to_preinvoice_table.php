<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%preinvoice}}`.
 */
class m231107_021432_add_total_amount_column_to_preinvoice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%preinvoice}}', 'total_amount', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%preinvoice}}', 'total_amount');
    }
}
