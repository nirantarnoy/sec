<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%employee}}`.
 */
class m250104_092303_add_position_column_to_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%employee}}', 'position', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%employee}}', 'position');
    }
}
