<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cash_advance}}`.
 */
class m250406_125922_create_cash_advance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cash_advance}}', [
            'id' => $this->primaryKey(),
            'trans_date' => $this->datetime(),
            'team_id' => $this->integer(),
            'name' => $this->string(),
            'in_amount' => $this->float(),
            'out_amount' => $this->float(),
            'balance_amount' => $this->float(),
            'work_name' => $this->string(),
            'quotation_ref_no' => $this->string(),
            'distance_total' => $this->float(),
            'express_amount' => $this->float(),
            'line_total' => $this->float(),
            'remark' => $this->string(),
            'created_by'=> $this->integer(),
            'created_at' => $this->integer(),
            'updated_by'=> $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cash_advance}}');
    }
}
