<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%purch_line}}`.
 */
class m241019_043059_add_purch_req_id_column_to_purch_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%purch_line}}', 'purch_req_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%purch_line}}', 'purch_req_id');
    }
}
