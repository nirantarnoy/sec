<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%vendor}}`.
 */
class m241019_055604_add_phone_column_to_vendor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%vendor}}', 'phone', $this->string());
        $this->addColumn('{{%vendor}}', 'email', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%vendor}}', 'phone');
        $this->dropColumn('{{%vendor}}', 'email');
    }
}
