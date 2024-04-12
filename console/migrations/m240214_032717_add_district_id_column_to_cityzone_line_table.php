<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cityzone_line}}`.
 */
class m240214_032717_add_district_id_column_to_cityzone_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cityzone_line}}', 'district_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cityzone_line}}', 'district_id');
    }
}
