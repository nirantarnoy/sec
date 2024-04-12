<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product}}`.
 */
class m240129_032355_add_created_at_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'created_at', $this->integer());
        $this->addColumn('{{%product}}', 'created_by', $this->integer());
        $this->addColumn('{{%product}}', 'updated_at', $this->integer());
        $this->addColumn('{{%product}}', 'updated_by', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'created_at');
        $this->dropColumn('{{%product}}', 'created_by');
        $this->dropColumn('{{%product}}', 'updated_at');
        $this->dropColumn('{{%product}}', 'updated_by');
    }
}
