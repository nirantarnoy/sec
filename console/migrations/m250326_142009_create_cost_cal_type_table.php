<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cost_cal_type}}`.
 */
class m250326_142009_create_cost_cal_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cost_cal_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cost_cal_type}}');
    }
}
