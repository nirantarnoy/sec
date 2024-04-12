<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%preinvoice}}`.
 */
class m231218_032839_add_from_date_column_to_preinvoice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%preinvoice}}', 'from_date', $this->datetime());
        $this->addColumn('{{%preinvoice}}', 'to_date', $this->datetime());
        $this->addColumn('{{%preinvoice}}', 'work_type_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%preinvoice}}', 'from_date');
        $this->dropColumn('{{%preinvoice}}', 'to_date');
        $this->dropColumn('{{%preinvoice}}', 'work_type_id');
    }
}
