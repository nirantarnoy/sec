<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%purch_line}}`.
 */
class m241029_012539_add_product_name_column_to_purch_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%purch_line}}', 'product_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%purch_line}}', 'product_name');
    }
}
