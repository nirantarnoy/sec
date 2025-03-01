<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%main_config}}`.
 */
class m250301_013725_create_main_config_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%main_config}}', [
            'id' => $this->primaryKey(),
            'is_cal_commission' => $this->integer(),
            'commission_per' => $this->float(),
            'job_vat_per' => $this->float(),
            'withholding_per' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%main_config}}');
    }
}
