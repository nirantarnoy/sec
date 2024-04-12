<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%quotation_rate}}`.
 */
class m230501_130625_create_quotation_rate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%quotation_rate}}', [
            'id' => $this->primaryKey(),
            'zone_id' => $this->integer(),
            'province_id'=>$this->integer(),
            'route_code' => $this->string(),
            'car_type_id' => $this->integer(),
            'distance' => $this->float(),
            'load_qty' => $this->float(),
            'price_current_rate' => $this->float(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_a' => $this->integer(),
            'updated_by' => $this->integer()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%quotation_rate}}');
    }
}
