<?php

use common\db\Migration;

/**
 * Handles the creation of table `{{%pages}}`.
 */
class m190318_134605_create_pages_table extends Migration
{
    private $table = '{{%pages}}';

    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'lang' => $this->lang(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'active' => $this->tinyInteger()->defaultValue(0),
            'in_menu' => $this->tinyInteger()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->createIndex('unique_slug_lang',$this->table,['slug', 'lang'], true);
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
