<?php

use yii\db\Migration;

/**
 * Handles the creation for table `supply_list`.
 * Has foreign keys to the tables:
 *
 * - `budget_group`
 */
class m160905_153232_create_supply_list_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('supply_list', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'name' => $this->text()->notNull(),
            'nsn' => $this->string(),
            'unit_issue' => $this->string(),
            'gpsc' => $this->string(),
            'price' => $this->decimal(25,2)->notNull(),
            'quantity' => $this->integer()->notNull(),
            'real_price' => $this->decimal(25,2),
            'real_quantity' => $this->integer(),
            'status' => $this->integer()->defaultValue(0),
            'remark' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        // creates index for column `group_id`
        $this->createIndex(
            'idx-supply_list-group_id',
            'supply_list',
            'group_id'
        );

        // add foreign key for table `budget_group`
        $this->addForeignKey(
            'fk-supply_list-group_id',
            'supply_list',
            'group_id',
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
        // drops foreign key for table `budget_group`
        $this->dropForeignKey(
            'fk-supply_list-group_id',
            'supply_list'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-supply_list-group_id',
            'supply_list'
        );

        $this->dropTable('supply_list');
    }
}
