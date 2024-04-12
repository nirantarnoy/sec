<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stock_trans}}`.
 */
class m240123_143438_create_stock_trans_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stock_trans}}', [
            'id' => $this->primaryKey(),
            'journal_no' => $this->string(),
            'trans_date' => $this->datetime(),
            'activity_type_id' => $this->integer(),
            'item_id' => $this->integer(),
            'qty' => $this->float(),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
            'stock_type_id' => $this->integer(),
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
