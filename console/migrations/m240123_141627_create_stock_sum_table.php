<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stock_sum}}`.
 */
class m240123_141627_create_stock_sum_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stock_sum}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer(),
            'warehouse_id' => $this->integer(),
            'item_id' => $this->integer(),
            'qty' => $this->float(),
            'last_update' => $this->datetime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stock_sum}}');
    }
}
