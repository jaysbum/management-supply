<?php

use yii\db\Migration;

/**
 * Handles the creation for table `budget_payment`.
 */
class m160908_034537_create_budget_payment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('budget_payment', [
            'id' => $this->primaryKey(),
            'request_id' => $this->integer()->notNull(),
            'month' => $this->integer()->notNull(),
            'year' => $this->integer()->notNull(),
            'total' => $this->decimal(25,2),
            'payment_date' => $this->date(),
            'remark' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        // creates index for column `group_id`
        $this->createIndex(
            'idx-budget_payment-request_id',
            'budget_payment',
            'request_id'
        );
        // add foreign key for table `budget_group`
        $this->addForeignKey(
            'fk-budget_payment-request_id',
            'budget_payment',
            'request_id',
            'request_supply',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('budget_payment');
    }
}
