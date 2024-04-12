<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%customer}}`.
 */
class m221209_111926_add_customer_group_id_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer}}', 'customer_group_id', $this->integer());
        $this->addColumn('{{%customer}}', 'phone', $this->string());
        $this->addColumn('{{%customer}}', 'email', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%customer}}', 'customer_group_id');
        $this->dropColumn('{{%customer}}', 'phone');
        $this->dropColumn('{{%customer}}', 'email');
    }
}
