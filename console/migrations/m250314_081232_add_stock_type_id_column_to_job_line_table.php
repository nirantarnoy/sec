<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job_line}}`.
 */
class m250314_081232_add_stock_type_id_column_to_job_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job_line}}', 'stock_type_id', $this->integer());
        $this->addColumn('{{%job_line}}', 'distributor_info', $this->string());
        $this->addColumn('{{%job_line}}', 'cost_category_type', $this->integer());
        $this->addColumn('{{%job_line}}', 'vat_type', $this->integer());
        $this->addColumn('{{%job_line}}', 'withholdingtax', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job_line}}', 'stock_type_id');
        $this->dropColumn('{{%job_line}}', 'distributor_info');
        $this->dropColumn('{{%job_line}}', 'cost_category_type');
        $this->dropColumn('{{%job_line}}', 'vat_type');
        $this->dropColumn('{{%job_line}}', 'withholdingtax');
    }
}
