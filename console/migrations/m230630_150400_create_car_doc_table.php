<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%car_doc}}`.
 */
class m230630_150400_create_car_doc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_doc}}', [
            'id' => $this->primaryKey(),
            'car_id' => $this->integer(),
            'doc_type_id' => $this->integer(),
            'doc_name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_doc}}');
    }
}
