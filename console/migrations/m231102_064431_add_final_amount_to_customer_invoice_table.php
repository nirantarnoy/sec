<?php

use yii\db\Migration;

/**
 * Class m231102_064431_add_final_amount_to_customer_invoice_table
 */
class m231102_064431_add_final_amount_to_customer_invoice_table extends Migration
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
        echo "m231102_064431_add_final_amount_to_customer_invoice_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231102_064431_add_final_amount_to_customer_invoice_table cannot be reverted.\n";

        return false;
    }
    */
}
