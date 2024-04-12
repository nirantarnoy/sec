<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%preinvoice}}`.
 */
class m231106_142632_add_customer_id_column_to_preinvoice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%preinvoice}}', 'customer_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%preinvoice}}', 'customer_id');
    }
}
