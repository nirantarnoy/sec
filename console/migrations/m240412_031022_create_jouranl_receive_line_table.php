<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jouranl_receive_line}}`.
 */
class m240412_031022_create_jouranl_receive_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%jouranl_receive_line}}', [
            'id' => $this->primaryKey(),
            'journal_rec_id' => $this->integer(),
            'product_id' => $this->integer(),
            'qty' => $this->float(),
            'price' => $this->float(),
            'line_total' => $this->float(),
            'status' => $this->integer(),
            'remark' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jouranl_receive_line}}');
    }
}
