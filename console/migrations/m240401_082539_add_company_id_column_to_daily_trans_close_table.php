<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%daily_trans_close}}`.
 */
class m240401_082539_add_company_id_column_to_daily_trans_close_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%daily_trans_close}}', 'company_id', $this->integer());
        $this->addColumn('{{%daily_trans_close}}', 'location_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%daily_trans_close}}', 'company_id');
        $this->dropColumn('{{%daily_trans_close}}', 'location_id');
    }
}
