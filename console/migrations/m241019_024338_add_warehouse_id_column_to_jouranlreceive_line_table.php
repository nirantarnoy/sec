<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%jouranlreceive_line}}`.
 */
class m241019_024338_add_warehouse_id_column_to_jouranlreceive_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%jouranl_receive_line}}', 'warehouse_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%jouranl_receive_line}}', 'warehouse_id');
    }
}
