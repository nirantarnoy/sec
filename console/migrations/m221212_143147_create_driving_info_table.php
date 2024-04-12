<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%driving_info}}`.
 */
class m221212_143147_create_driving_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%driving_info}}', [
            'id' => $this->primaryKey(),
            'emp_id' => $this->integer(),
            'card_no' => $this->string(),
            'card_type' => $this->integer(),
            'card_issue_date' => $this->datetime(),
            'card_expire_date' => $this->datetime(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%driving_info}}');
    }
}
