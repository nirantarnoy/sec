<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%customer}}`.
 */
class m240503_152006_add_first_name_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer}}', 'first_name', $this->string());
        $this->addColumn('{{%customer}}', 'last_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%customer}}', 'first_name');
        $this->dropColumn('{{%customer}}', 'last_name');
    }
}
