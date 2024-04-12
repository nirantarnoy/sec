<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%receipt_record}}`.
 */
class m240105_111228_add_trans_ref_id_column_to_reciept_record_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%reciept_record}}', 'trans_ref_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%reciept_record}}', 'trans_ref_id');
    }
}
