<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%unit}}`.
 */
class m250225_134639_add_code_column_to_unit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%unit}}', 'code', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%unit}}', 'code');
    }
}
