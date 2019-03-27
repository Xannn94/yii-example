<?php

use common\db\Migration;

/**
 * Handles the creation of table `{{%product_categories}}`.
 */
class m190324_125517_create_product_category_table extends Migration
{
    private $table = '{{%product_categories}}';
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->unsigned(),
            'lang' => $this->lang(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string(),
            'active' => $this->tinyInteger()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
