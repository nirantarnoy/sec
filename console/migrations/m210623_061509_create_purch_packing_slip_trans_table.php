<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%purch_packing_slip_trans}}`.
 */
class m210623_061509_create_purch_packing_slip_trans_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%purch_packing_slip_trans}}', [
            'id' => $this->primaryKey(),
            'purch_packing_id' => $this->integer(),
            'product_id' => $this->integer(),
            'qty' => $this->float(),
            'price' => $this->float(),
            'total_amount' => $this->float(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%purch_packing_slip_trans}}');
    }
}
