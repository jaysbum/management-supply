<?php

use yii\db\Migration;

class m160918_162439_add_column_to_catalog_group_table extends Migration
{
    public function up()
    {
        $this->addColumn('catalog_group', 'start_niin', $this->integer()->notNull());
        $this->addColumn('catalog_group', 'end_niin', $this->integer()->notNull());
    }

    public function down()
    {
        $this->dropColumn('catalog_group', 'start_niin');
        $this->dropColumn('catalog_group', 'start_niin');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
