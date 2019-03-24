<?php

use common\db\Migration;

/**
 * Handles the creation of table `{{%menus}}`.
 */
class m190319_141621_create_menus_table extends Migration
{
    private $table = '{{%menus}}';

    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'lang' => $this->lang(),
            'page_id' => $this->integer()->notNull()->defaultValue(0),
            'tree' => $this->integer()->notNull()->defaultValue(0),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
