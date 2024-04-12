<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%route_plan}}`.
 */
class m221213_015838_create_route_plan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%route_plan}}', [
            'id' => $this->primaryKey(),
            'des_name' => $this->string(),
            'des_province_id' => $this->integer(),
            'total_distanct' => $this->float(),
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
        $this->dropTable('{{%route_plan}}');
    }
}
