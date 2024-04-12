<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%daily_trans_close}}`.
 */
class m240401_082436_create_daily_trans_close_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%daily_trans_close}}', [
            'id' => $this->primaryKey(),
            'trans_date' => $this->datetime(),
            'trans_year' => $this->integer(),
            'trans_month' => $this->integer(),
            'balance_amount' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%daily_trans_close}}');
    }
}
