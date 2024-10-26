<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%vendor}}`.
 */
class m241026_091352_add_contact_name_column_to_vendor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%vendor}}', 'contact_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%vendor}}', 'contact_name');
    }
}
