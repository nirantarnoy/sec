<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quotation_line}}`.
 */
class m241107_032957_add_size_desc_column_to_quotation_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation_line}}', 'size_desc', $this->string());
        $this->addColumn('{{%quotation_line}}', 'mat_desc', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation_line}}', 'size_desc');
        $this->dropColumn('{{%quotation_line}}', 'mat_desc');
    }
}
