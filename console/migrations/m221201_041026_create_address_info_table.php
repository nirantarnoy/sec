<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%address_info}}`.
 */
class m221201_041026_create_address_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%address_info}}', [
            'id' => $this->primaryKey(),
            'party_type' => $this->integer(),
            'party_id' => $this->integer(),
            'address' => $this->string(),
            'street' => $this->string(),
            'district_id' => $this->integer(),
            'city_id' => $this->integer(),
            'province_id' => $this->integer(),
            'zipcode' => $this->string(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%address_info}}');
    }
}
