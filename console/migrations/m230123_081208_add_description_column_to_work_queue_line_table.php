<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%work_queue_line}}`.
 */
class m230123_081208_add_description_column_to_work_queue_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%work_queue_line}}', 'description', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%work_queue_line}}', 'description');
    }
}
