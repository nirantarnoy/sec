<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%driver_license}}`.
 */
class m221201_040130_create_driver_license_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%driver_license}}', [
            'id' => $this->primaryKey(),
            'emp_id' => $this->integer(),
            'seq_no' => $this->integer(),
            'license_type_id' => $this->integer(),
            'license_no' => $this->string(),
            'issue_date' => $this->datetime(),
            'issue_by' => $this->string(),
            'expired_date' => $this->datetime(),
            'license_photo' => $this->string(),
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
        $this->dropTable('{{%driver_license}}');
    }
}
