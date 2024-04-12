<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%contact_info}}`.
 */
class m221210_061311_add_contact_name_column_to_contact_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%contact_info}}', 'contact_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%contact_info}}', 'contact_name');
    }
}
