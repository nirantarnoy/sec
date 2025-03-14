<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%unit}}`.
 */
class m250310_133404_add_can_new_column_to_unit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%unit}}', 'can_new', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%unit}}', 'can_new');
    }
}
