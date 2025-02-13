<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%employee}}`.
 */
class m250104_092722_add_code_column_to_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%employee}}', 'code', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%employee}}', 'code');
    }
}
