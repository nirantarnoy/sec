<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%quotation}}`.
 */
class m241015_124859_create_quotation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%quotation}}', [
            'id' => $this->primaryKey(),
            'quotation_no' => $this->string(),
            'quotation_date' => $this->datetime(),
            'customer_id' => $this->integer(),
            'customer_name' => $this->string(),
            'attn' => $this->string(),
            'from' => $this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'remark' => $this->string(),
            'description' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%quotation}}');
    }
}
