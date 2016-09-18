<?php

use yii\db\Migration;

/**
 * Handles the creation for table `request_item`.
 */
class m160907_120542_create_request_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('request_item', [
            'id' => $this->primaryKey(),
            'supply_id' => $this->integer()->notNull(),
            'request_id' => $this->integer()->notNull(),
            'budget_id' => $this->integer()->notNull(),
            'price' => $this->decimal(25,2)->notNull(),
            'quantity' => $this->decimal(25,2)->notNull(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        // creates index for column `group_id`
        $this->createIndex(
            'idx-request_item-supply_id',
            'request_item',
            'supply_id'
        );
        // add foreign key for table `budget_group`
        $this->addForeignKey(
            'fk-request_item-supply_id',
            'request_item',
            'supply_id',
            'supply_list',
            'id',
            'CASCADE'
        );
        // creates index for column `group_id`
        $this->createIndex(
            'idx-request_item-request_id',
            'request_item',
            'request_id'
        );
        // add foreign key for table `budget_group`
        $this->addForeignKey(
            'fk-request_item-request_id',
            'request_item',
            'request_id',
            'request_supply',
            'id',
            'CASCADE'
        );
        // creates index for column `group_id`
        $this->createIndex(
            'idx-request_item-budget_id',
            'request_item',
            'budget_id'
        );
        // add foreign key for table `budget_group`
        $this->addForeignKey(
            'fk-request_item-budget_id',
            'request_item',
            'budget_id',
            'budget_group',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('request_item');
    }
}
