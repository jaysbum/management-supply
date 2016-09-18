<?php

use yii\db\Migration;

/**
 * Handles the creation for table `budget_group`.
 * Has foreign keys to the tables:
 *
 * - `budget_main_group`
 */
class m160905_094804_create_budget_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('budget_group', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'desc' => $this->string(),
            'year' => $this->integer()->notNull(),
            'total' => $this->decimal(25,2)->notNull(),
            'parent' => $this->boolean()->notNull(),
            'parent_id' => $this->integer(),
            'manage' => $this->boolean()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }
    public function down()
    {
        $this->dropTable('budget_group');
    }
}
