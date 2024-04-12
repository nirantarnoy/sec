<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%car}}`.
 */
class m231114_093106_add_company_id_column_to_car_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//        $this->addColumn('{{%car}}', 'company_id', $this->integer());
//        $this->addColumn('{{%customer}}', 'company_id', $this->integer());
//        $this->addColumn('{{%employee}}', 'company_id', $this->integer());
//        $this->addColumn('{{%user}}', 'company_id', $this->integer());
//        $this->addColumn('{{%usergroup}}', 'company_id', $this->integer());
//        $this->addColumn('{{%work_queue}}', 'company_id', $this->integer());
//        $this->addColumn('{{%work_option_type}}', 'company_id', $this->integer());
//        $this->addColumn('{{%position}}', 'company_id', $this->integer());
//        $this->addColumn('{{%work_type_invoice_info}}', 'company_id', $this->integer());
//        $this->addColumn('{{%item}}', 'company_id', $this->integer());
 //       $this->addColumn('{{%journal_trans}}', 'company_id', $this->integer());
  //      $this->addColumn('{{%customergroup}}', 'company_id', $this->integer());
  //      $this->addColumn('{{%journal_trans}}', 'company_id', $this->integer());
  //      $this->addColumn('{{%fuel_issue}}', 'company_id', $this->integer());
        $this->addColumn('{{%route_plan}}', 'company_id', $this->integer());
        $this->addColumn('{{%quotation_rate}}', 'company_id', $this->integer());
        $this->addColumn('{{%quotation_title}}', 'company_id', $this->integer());
        $this->addColumn('{{%fixcost_title}}', 'company_id', $this->integer());
        $this->addColumn('{{%dropoff_place}}', 'company_id', $this->integer());
        $this->addColumn('{{%customer_invoice}}', 'company_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $this->dropColumn('{{%car}}', 'company_id');
//        $this->dropColumn('{{%customer}}', 'company_id');
//        $this->dropColumn('{{%employee}}', 'company_id');
//        $this->dropColumn('{{%user}}', 'company_id');
//        $this->dropColumn('{{%usergroup}}', 'company_id');
//        $this->dropColumn('{{%work_queue}}', 'company_id');
//        $this->dropColumn('{{%work_option_type}}', 'company_id');
//        $this->dropColumn('{{%position}}', 'company_id');
//        $this->dropColumn('{{%work_type_invoice_info}}', 'company_id');
//        $this->dropColumn('{{%item}}', 'company_id');
 //       $this->dropColumn('{{%journal_trans}}', 'company_id');
 //       $this->dropColumn('{{%customergroup}}', 'company_id');
  //      $this->dropColumn('{{%journal_trans}}', 'company_id');
 //       $this->dropColumn('{{%fuel_issue}}', 'company_id');
        $this->dropColumn('{{%route_plan}}', 'company_id');
        $this->dropColumn('{{%quotation_rate}}', 'company_id');
        $this->dropColumn('{{%quotation_title}}', 'company_id');
        $this->dropColumn('{{%fixcost_title}}', 'company_id');
        $this->dropColumn('{{%dropoff_place}}', 'company_id');
        $this->dropColumn('{{%customer_invoice}}', 'company_id');
    }
}
