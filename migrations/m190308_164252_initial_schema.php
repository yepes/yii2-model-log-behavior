<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m190308_164252_initial_schema
 */
class m190308_164252_initial_schema extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('goltratec_log', [
            'id' => $this->primaryKey(),
            'old_attributes' => Schema::TYPE_TEXT,
            'new_attributes' => Schema::TYPE_TEXT,
            'user' => Schema::TYPE_INTEGER,
            'event' => $this->string(30),
            'object' => $this->string(65),
            'date' => Schema::TYPE_DATETIME,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190308_164252_initial_schema cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190308_164252_initial_schema cannot be reverted.\n";

        return false;
    }
    */
}
