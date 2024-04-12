<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quotation_title}}`.
 */
class m240113_134835_add_car_type_id_column_to_quotation_title_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation_title}}', 'car_type_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation_title}}', 'car_type_id');
    }
}
