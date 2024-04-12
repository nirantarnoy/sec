<?php

use yii\db\Migration;

/**
 * Class m221209_110656_add_customer_group_id_column_table
 */
class m221209_110656_add_customer_group_id_column_table extends Migration
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
        echo "m221209_110656_add_customer_group_id_column_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221209_110656_add_customer_group_id_column_table cannot be reverted.\n";

        return false;
    }
    */
}
