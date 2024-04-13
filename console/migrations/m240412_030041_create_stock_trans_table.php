<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stock_trans}}`.
 */
class m240412_030041_create_stock_trans_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stock_trans}}', [
            'id' => $this->primaryKey(),
            'trans_date' => $this->datetime(),
            'activity_type_id' => $this->integer(),
            'product_id' => $this->integer(),
            'qty' => $this->float(),
            'trans_ref_id' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'remark' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stock_trans}}');
    }
}
