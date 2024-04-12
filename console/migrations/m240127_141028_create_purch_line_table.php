<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%purch_line}}`.
 */
class m240127_141028_create_purch_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%purch_line}}', [
            'id' => $this->primaryKey(),
            'purch_id' => $this->integer(),
            'product_id' => $this->integer(),
            'qry' => $this->float(),
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
        $this->dropTable('{{%purch_line}}');
    }
}
