<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact_info}}`.
 */
class m241025_014910_create_contact_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact_info}}', [
            'id' => $this->primaryKey(),
            'party_ref_id' => $this->integer(),
            'party_type_id' => $this->integer(),
            'dept_name'=>$this->string(),
            'contact_name'=>$this->string(),
            'status' => $this->integer(),
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
