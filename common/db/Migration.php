<?php

namespace common\db;

use Yii;
use yii\db\Migration as Base;

class Migration extends Base
{
    protected $languages;
    protected $defaultLanguage;

    public function __construct(array $config = [])
    {
        $this->defaultLanguage = Yii::$app->language;
        $this->languages = Yii::$app->params['languages'];
        parent::__construct($config);
    }

    public function lang()
    {
        return 'ENUM("' . implode('","', array_values($this->languages)) . '") DEFAULT "' . $this->defaultLanguage . '"';
    }

    public function checkCountLanguage()
    {
        return count($this->languages) < 2;
    }
}