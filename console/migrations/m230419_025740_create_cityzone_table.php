<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cityzone}}`.
 */
class m230419_025740_create_cityzone_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cityzone}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'province_id' => $this->integer(),
            'city_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cityzone}}');
    }
}
