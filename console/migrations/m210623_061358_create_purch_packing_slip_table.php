<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%purch_packing_slip}}`.
 */
class m210623_061358_create_purch_packing_slip_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%purch_packing_slip}}', [
            'id' => $this->primaryKey(),
            'journal_no' => $this->string(),
            'trans_date' => $this->datetime(),
            'purch_id' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%purch_packing_slip}}');
    }
}
