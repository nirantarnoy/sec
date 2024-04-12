<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%social_per_trans}}`.
 */
class m231216_030246_create_social_per_trans_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%social_per_trans}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer(),
            'trans_date' => $this->datetime(),
            'social_per' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%social_per_trans}}');
    }
}
