<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact_info}}`.
 */
class m221201_040858_create_contact_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact_info}}', [
            'id' => $this->primaryKey(),
            'party_type' => $this->integer(),
            'party_id' => $this->integer(),
            'type_id' => $this->integer(),
            'contact_no' => $this->string(),
            'is_primary' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contact_info}}');
    }
}
