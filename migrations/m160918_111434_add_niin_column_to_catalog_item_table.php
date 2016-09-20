<?php

use yii\db\Migration;

/**
 * Handles adding niin to table `catalog_item`.
 */
class m160918_111434_add_niin_column_to_catalog_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('catalog_item', 'niin', $this->integer()->notNull());
        $this->addColumn('catalog_item', 'new', $this->boolean());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('catalog_item', 'niin');
        $this->dropColumn('catalog_item', 'new');
    }
}
