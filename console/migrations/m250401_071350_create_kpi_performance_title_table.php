<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kpi_performance_title}}`.
 */
class m250401_071350_create_kpi_performance_title_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kpi_performance_title}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description'=>$this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kpi_performance_title}}');
    }
}
