<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%preinvoice_line}}`.
 */
class m231106_134055_create_preinvoice_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%preinvoice_line}}', [
            'id' => $this->primaryKey(),
            'preinvoice_id' => $this->integer(),
            'work_queue_id' => $this->integer(),
            'total_amount' => $this->float(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%preinvoice_line}}');
    }
}
