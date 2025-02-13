<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m250104_071938_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'sku' => $this->string(),
            'name' => $this->string(),
            'description' => $this->string(),
            'product_cat_id' => $this->integer(),
            'brand_id' => $this->integer(),
            'model_name' => $this->string(),
            'serial_no' => $this->string(),
            'cost' => $this->float(),
            'dealer_price' => $this->float(),
            'price_vat_per' => $this->float(),
            'status' => $this->integer(),
            'unit_id' => $this->integer(),
            'onhand_qty' => $this->float(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
