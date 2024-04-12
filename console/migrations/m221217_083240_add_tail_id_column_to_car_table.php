<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%car}}`.
 */
class m221217_083240_add_tail_id_column_to_car_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%car}}', 'tail_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%car}}', 'tail_id');
    }
}
