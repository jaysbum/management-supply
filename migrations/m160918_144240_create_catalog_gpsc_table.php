<?php

use yii\db\Migration;

/**
 * Handles the creation for table `catalog_gpsc`.
 */
class m160918_144240_create_catalog_gpsc_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('catalog_gpsc', [
            'id' => $this->primaryKey(),
            'gpsc' => $this->string(14)->notNull()->unique(),
            'desc' => $this->text(),
            'group' => $this->string(8),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('catalog_gpsc');
    }
}
