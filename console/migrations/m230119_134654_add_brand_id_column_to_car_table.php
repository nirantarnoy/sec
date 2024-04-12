<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%car}}`.
 */
class m230119_134654_add_brand_id_column_to_car_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%car}}', 'brand_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%car}}', 'brand_id');
    }
}
