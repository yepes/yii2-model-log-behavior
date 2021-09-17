<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%log}}`.
 */
class m210917_105805_add_object_id_column_to_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('goltratec_log', 'object_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('goltratec_log', 'object_id');
    }
}
