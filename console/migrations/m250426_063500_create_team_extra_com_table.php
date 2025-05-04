<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%team_extra_com}}`.
 */
class m250426_063500_create_team_extra_com_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%team_extra_com}}', [
            'id' => $this->primaryKey(),
            'target_year_id' => $this->integer(),
            'total_sale_price' => $this->float(),
            'total_sale_profit' => $this->float(),
            'ttar_per' => $this->float(),
            'ttar_amount' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%team_extra_com}}');
    }
}
