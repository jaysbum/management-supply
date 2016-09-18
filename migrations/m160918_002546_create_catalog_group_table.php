<?php

use yii\db\Migration;

/**
 * Handles the creation for table `catalog_group`.
 */
class m160918_002546_create_catalog_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('catalog_group', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'parent_id' => $this->integer()->notNull(),
            'list_item' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('catalog_group');
    }
}
