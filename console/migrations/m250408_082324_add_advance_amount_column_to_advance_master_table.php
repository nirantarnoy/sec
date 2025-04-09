<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%advance_master}}`.
 */
class m250408_082324_add_advance_amount_column_to_advance_master_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%advance_master}}', 'advance_amount', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%advance_master}}', 'advance_amount');
    }
}
