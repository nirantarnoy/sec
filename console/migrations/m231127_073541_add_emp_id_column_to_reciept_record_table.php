<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%reciept_record}}`.
 */
class m231127_073541_add_emp_id_column_to_reciept_record_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%reciept_record}}', 'emp_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%reciept_record}}', 'emp_id');
    }
}
