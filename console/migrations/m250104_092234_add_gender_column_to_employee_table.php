<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%employee}}`.
 */
class m250104_092234_add_gender_column_to_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%employee}}', 'gender', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%employee}}', 'gender');
    }
}
