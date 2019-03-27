<?php

use common\db\Migration;

/**
 * Handles the creation of table `{{%product_filter_group}}`.
 */
class m190324_155708_create_product_filter_group_table extends Migration
{
    private $table = "{{%product_filter_groups}}";
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'lang' => $this->lang(),
            'title' => $this->string()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
