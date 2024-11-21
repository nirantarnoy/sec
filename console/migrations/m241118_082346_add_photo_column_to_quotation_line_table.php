<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quotation_line}}`.
 */
class m241118_082346_add_photo_column_to_quotation_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation_line}}', 'photo', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation_line}}', 'photo');
    }
}
