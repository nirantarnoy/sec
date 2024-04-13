<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jouranl_issue_line}}`.
 */
class m240412_031302_create_jouranl_issue_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%jouranl_issue_line}}', [
            'id' => $this->primaryKey(),
            'journal_issue_id' => $this->integer(),
            'product_id' => $this->integer(),
            'qty' => $this->float(),
            'price' => $this->float(),
            'line_total' => $this->float(),
            'status' => $this->integer(),
            'remark' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jouranl_issue_line}}');
    }
}
