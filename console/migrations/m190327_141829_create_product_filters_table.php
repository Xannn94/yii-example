<?php

use common\db\Migration;

/**
 * Handles the creation of table `{{%product_filters}}`.
 */
class m190327_141829_create_product_filters_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%product_filters}}', [
            'id'       => $this->primaryKey(),
            'lang'     => $this->lang(),
            'group_id' => $this->integer()->unsigned()->notNull(),
            'title'    => $this->string()->notNull(),
            'priority' => $this->integer()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%product_filters}}');
    }
}
