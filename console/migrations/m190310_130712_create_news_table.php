<?php

use common\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m190310_130712_create_news_table extends Migration
{
    private $table = '{{%news}}';

    public function safeUp()
    {
        $columns = [
            'id' => $this->primaryKey(),
            'lang' => $this->lang(),
            'title' => $this->string()->notNull(),
            'preview' => $this->text()->notNull(),
            'content' => $this->text()->notNull(),
            'image' => $this->string()->null(),
            'active' => $this->tinyInteger()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ];

        if ($this->checkCountLanguage()) {
            unset($columns['lang']);
        }

        $this->createTable($this->table, $columns);
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
