<?php
namespace backend\widgets;

use Yii;
use yii\base\Widget;

/**
 * AdminNavBar widget render admin menu
 * @author Alexander Khan <xannn94@yandex.com>
 */
class AdminNavBar extends Widget
{
    /**
     * Menu create in params config
     * @var array $configMenu
    */
    private $configMenu;

    /**
     * Title for brand
     * @var string
    */
    public $brandLabel;

    /**
     * Url for brand
     * @var string
     */
    public $brandUrl;

    /**
     * Visible brand
     * @var boolean $brandVisible
    */
    public $brandVisible = false;

    /**
     * Visible current user
     * @var boolean $userVisible
    */
    public $userVisible = false;

    private function getUrlsMainMenuItems() : array
    {
        $config = $this->configMenu;

        $items = array_filter($config,function ($item) {
            if (isset($item['items'])) {
                return false;
            }

            return true;
        });

        $urls = array_map(function ($item) {
            return $item['url'];
        },$items);

        return $urls;
    }

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        $this->configMenu = Yii::$app->params['menu'];
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        return $this->render('admin_navbar',[
            'adminMenu' => $this
        ]);
    }

    /**
     * @return array
     */
    public function getConfigMenu()
    {
        return $this->configMenu;
    }

    public function isCurrentGroup() : bool
    {
        if (array_key_exists(Yii::$app->controller->id, $this->configMenu['content']['items'])) {
            return true;
        }

        return false;
    }

    public function isCurrentItem(string $url) : bool
    {
        if (Yii::$app->request->url === $url) {
            return true;
        }

        return false;
    }

    public function isCurrentMain(string $url) : bool
    {
        if (in_array($url, $this->getUrlsMainMenuItems()) && Yii::$app->request->url === $url) {
            return true;
        }

        return false;
    }
}
