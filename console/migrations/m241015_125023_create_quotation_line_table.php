<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%quotation_line}}`.
 */
class m241015_125023_create_quotation_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%quotation_line}}', [
            'id' => $this->primaryKey(),
            'quotation_id' => $this->integer(),
            'product_id' => $this->integer(),
            'qty' => $this->float(),
            'unit_id' => $this->integer(),
            'line_price' => $this->float(),
            'line_total' => $this->float(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%quotation_line}}');
    }
}
