<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cityzone_line}}`.
 */
class m230419_031112_create_cityzone_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cityzone_line}}', [
            'id' => $this->primaryKey(),
            'cityzone_id'=> $this->integer(),
            'province_id' => $this->integer(),
            'city_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cityzone_line}}');
    }
}
