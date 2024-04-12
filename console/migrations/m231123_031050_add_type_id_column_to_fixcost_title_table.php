<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%fixcost_title}}`.
 */
class m231123_031050_add_type_id_column_to_fixcost_title_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%fixcost_title}}', 'type_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%fixcost_title}}', 'type_id');
    }
}
