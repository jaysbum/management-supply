<?php

use yii\db\Migration;

/**
 * Handles the creation for table `request_supply`.
 */
class m160907_115928_create_request_supply_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('request_supply', [
            'id' => $this->primaryKey(),
            'doc_num' => $this->integer()->notNull(),
            'doc_date' => $this->date()->notNull(),
            'year' => $this->integer()->notNull(),
            'status' => $this->integer(),
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
        $this->dropTable('request_supply');
    }
}
