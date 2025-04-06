<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%distributor}}`.
 */
class m250327_061437_add_can_new_column_to_distributor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%distributor}}', 'can_new', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%distributor}}', 'can_new');
    }
}
