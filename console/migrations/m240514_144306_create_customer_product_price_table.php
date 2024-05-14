<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer_product_price}}`.
 */
class m240514_144306_create_customer_product_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer_product_price}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(),
            'product_id' => $this->integer(),
            'sale_price' => $this->float(),
            'status' => $this->integer(),
            'price_date' => $this->datetime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customer_product_price}}');
    }
}
