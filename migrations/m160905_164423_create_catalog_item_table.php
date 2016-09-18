<?php

use yii\db\Migration;

/**
 * Handles the creation for table `catalog_item`.
 */
class m160905_164423_create_catalog_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('catalog_item', [
            'id' => $this->primaryKey(),
            'nsn' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'unit_issue' => $this->string()->notNull(),
            'price' => $this->decimal(25,2),
            'gpsc' => $this->string(),
            'remark' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('catalog_item');
    }
}
