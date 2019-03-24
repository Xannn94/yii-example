<?php

use common\repositories\MenuRepository;
use yii\db\Migration;

/**
 * Class m190320_155933_insert_root_menu_items
 */
class m190320_155933_insert_root_menu_items extends Migration
{
    private $table = '{{%menus}}';
    private $columns = [
        'lang',
        'tree',
        'lft' ,
        'rgt' ,
        'depth',
        'name',
        'slug'
    ];

    public function safeUp()
    {
        $items = [];
        $i     = 1;
        foreach (Yii::$app->params['languages'] as $language) {
            foreach (MenuRepository::$menus as $item) {
                $items[] = [
                    $language,
                    $i,
                    1,
                    2,
                    0,
                    Yii::t('backend/modules/menu/root-items', $item),
                    $item
                ];

                $i++;
            }
        }

        $this->db->createCommand()->batchInsert($this->table, $this->columns, $items)->execute();
    }

    public function safeDown()
    {

    }
}
