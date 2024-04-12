<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cash_record}}`.
 */
class m240108_130311_add_pay_for_type_id_column_to_cash_record_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cash_record}}', 'pay_for_type_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cash_record}}', 'pay_for_type_id');
    }
}
