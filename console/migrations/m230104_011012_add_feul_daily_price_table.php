<?php

use yii\db\Migration;

/**
 * Class m230104_011012_add_feul_daily_price_table
 */
class m230104_011012_add_feul_daily_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230104_011012_add_feul_daily_price_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230104_011012_add_feul_daily_price_table cannot be reverted.\n";

        return false;
    }
    */
}
