<?php

use yii\db\Migration;

/**
 * Handles adding parent_nsn to table `catalog_item`.
 */
class m160918_160156_add_parent_nsn_column_to_catalog_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('catalog_item', 'parent_nsn', $this->string(13)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('catalog_item', 'parent_nsn');
    }
}
