<?php

use yii\db\Migration;

/**
 * Handles the creation for table `receive_item`.
 */
class m160908_154030_create_receive_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('receive_item', [
            'id' => $this->primaryKey(),
            'receive_id' => $this->integer()->notNull(),
            'supply_id' => $this->integer()->notNull(),
            'price' => $this->decimal(25,2)->notNull(),
            'quantity' => $this->integer()->notNull(),
            'remark' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        // creates index for column `group_id`
        $this->createIndex(
            'idx-receive_item-supply_id',
            'receive_item',
            'supply_id'
        );
        // add foreign key for table `budget_group`
        $this->addForeignKey(
            'fk-receive_item-supply_id',
            'receive_item',
            'supply_id',
            'supply_list',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-receive_item-receive_id',
            'receive_item',
            'receive_id'
        );
        // add foreign key for table `budget_group`
        $this->addForeignKey(
            'fk-receive_item-receive_id',
            'receive_item',
            'receive_id',
            'receive_supply',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('receive_item');
    }
}
