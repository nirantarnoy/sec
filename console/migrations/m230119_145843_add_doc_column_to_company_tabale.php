<?php

use yii\db\Migration;

/**
 * Class m230119_145843_add_doc_column_to_company_tabale
 */
class m230119_145843_add_doc_column_to_company_tabale extends Migration
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
        echo "m230119_145843_add_doc_column_to_company_tabale cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230119_145843_add_doc_column_to_company_tabale cannot be reverted.\n";

        return false;
    }
    */
}
