<?php

use common\db\Migration;

/**
 * Handles the creation of table `{{%widgets}}`.
 */
class m190319_133055_create_widgets_table extends Migration
{
    private $table = '{{%widgets}}';

    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'lang' => $this->lang(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'active' => $this->tinyInteger()->defaultValue(0),
            'type'   => 'ENUM("text", "redactor") DEFAULT "text"',
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->createIndex('unique_slug_lang',$this->table,['slug', 'lang'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
