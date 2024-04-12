<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cash_record}}`.
 */
class m240213_151655_add_office_id_column_to_cash_record_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cash_record}}', 'office_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cash_record}}', 'office_id');
    }
}
