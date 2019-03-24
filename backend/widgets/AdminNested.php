<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19.03.2019
 * Time: 20:58
 */

namespace backend\widgets;


use klisl\nestable\Nestable;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class AdminNested extends Nestable
{
    /**
     * Render the list items for the sortable widget
     *
     * @param array $_items
     *
     * @return string
     */
    protected function renderItems($_items = NULL)
    {
        $_items = is_null($_items) ? $this->items : $_items;
        $items = '';
        $dataid = 0;
        foreach ($_items as $item) {

            $options = ArrayHelper::getValue($item, 'options', ['class' => 'dd-item dd3-item']);
            $options = ArrayHelper::merge($this->itemOptions, $options);
            $dataId  = ArrayHelper::getValue($item, 'id', $dataid++);
            $options = ArrayHelper::merge($options, ['data-id' => $dataId]);

            $contentOptions = ArrayHelper::getValue($item, 'contentOptions', ['class' => 'dd3-content']);
            $content = $this->handleLabel;

            $id = $item['id']; //id item
            //create links (GridView) for viewing and manipulating the items.
            $spanUpdate = Html::tag('i', null, ['class' => "fa fa-pencil"]);
            $aUpdate = Html::tag('a', $spanUpdate . '&nbsp; ', ['title' => 'Update', 'aria-label' => 'Update', 'data-pjax' => '0', 'href'=> $this->update .'&id=' . $id]);
            $spanDelete = Html::tag('i', null, ['class' => "fa fa-trash"]);
            $aDelete = Html::tag('a', $spanDelete . '&nbsp; ', ['title' => 'Delete', 'aria-label' => 'Delete', 'data-pjax' => '0', 'data-confirm' => \Yii::t('backend/app','sure.delete'), 'data-method' => 'post', 'href'=> $this->delete .'?id=' . $id]);
            if ($item['root']) {
                $links = Html::tag('div','', ['class' => "actionColumn"]);
            } else {
                $links = Html::tag('div',  $aUpdate . $aDelete, ['class' => "actionColumn"]);
            }

            $item['content'] .= $links;


            $content .= Html::tag('div', ArrayHelper::getValue($item, 'content', ''), $contentOptions);

            $children = ArrayHelper::getValue($item, 'children', []);
            if (!empty($children)) {
                // recursive rendering children items
                $content .= Html::beginTag('ol', ['class' => 'dd-list']);
                $content .= $this->renderItems($children);
                $content .= Html::endTag('ol');
            }

            $items .= Html::tag('li', $content, $options) . PHP_EOL;
        }
        return $items;
    }

    /**
     * put your comment there...
     *
     * @param $activeQuery \yii\db\ActiveQuery
     * @return array
     */
    protected function prepareItems($activeQuery)
    {
        $items = [];
        foreach ($activeQuery->all() as $model) {
            $name = ArrayHelper::getValue($this->modelOptions, 'name', 'name');
            $items[] = [
                'id'       => $model->getPrimaryKey(),
                'root' => $model->isRoot(),
                'content'  => (is_callable($name) ? call_user_func($name, $model) : $model->{$name}),
                'children' => $this->prepareItems($model->children(1)),
            ];
        }
        return $items;
    }
}