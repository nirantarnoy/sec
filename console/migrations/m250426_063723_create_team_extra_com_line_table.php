<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%team_extra_com_line}}`.
 */
class m250426_063723_create_team_extra_com_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%team_extra_com_line}}', [
            'id' => $this->primaryKey(),
            'team_extra_com_id' => $this->integer(),
            'emp_id' => $this->integer(),
            'sale_price' => $this->float(),
            'sale_profit' => $this->float(),
            'ptar_per' => $this->float(),
            'ppr_per' => $this->float(),
            'sum_ttat' => $this->float(),
            'sum_ptar' => $this->float(),
            'sum_ppr' => $this->float(),
            'sum_total' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%team_extra_com_line}}');
    }
}
