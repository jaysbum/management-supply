<?php

use yii\db\Migration;

/**
 * Handles the creation for table `receive_supply`.
 */
class m160908_154023_create_receive_supply_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('receive_supply', [
            'id' => $this->primaryKey(),
            'doc_num' => $this->integer()->notNull(),
            'year' => $this->integer()->notNull(),
            'doc_date' => $this->date()->notNull(),
            'remark' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('receive_supply');
    }
}
