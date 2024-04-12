<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cityzone_district_line}}`.
 */
class m240214_033640_create_cityzone_district_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cityzone_district_line}}', [
            'id' => $this->primaryKey(),
            'cityzone_id' => $this->integer(),
            'province_id' => $this->integer(),
            'city_id' => $this->integer(),
            'district_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cityzone_district_line}}');
    }
}
