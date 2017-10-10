<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

use yii\base\Component;
use common\models\Setting;
use common\models\MenuItem;
use common\models\Menu;
use common\models\Category;
use common\models\Widget;
use common\models\Product;
use common\models\Slide;
use common\models\Blog;

class SettingComponent extends Component {

    public function get($key) {
        $model = Setting::find()->where(['key' => $key])->one();
        return nl2br($model->value);
    }

    public function widget($key, $limit = 10) {
        $model = Widget::find()->where(['key' => $key])->one();
        if (!empty($model)) {
            $product = Product::find()->where(['widget' => $model->id, 'status' => Product::PUBLIC_ACTIVE])->limit($limit)->orderBy(['created_at' => SORT_DESC])->all();
            return ['widget' => $model, 'product' => $product];
        }
    }

    public function menu($key) {
        $menu = Menu::find()->where(['key' => $key])->one();
        $result = static::recrusive($menu->id);
        return $result;
    }

    private static function recrusive($menu_id, $parent = NULL) {
        $items = MenuItem::find()->where(['menu_id' => $menu_id, 'parent_id' => $parent])->orderBy(['order' => SORT_ASC])->all();
        $result = [];
        if (!empty($items)) {
            foreach ($items as $key => $item) {
                $result[] = [
                    'label' => $item->title,
                    'url' => $item->url,
                    'items' => static::recrusive($menu_id, $item->id)
                ];
            }
        }

        return $result;
    }

    public function category($parent = NULL) {
        $items = Category::find()->where(['parent_id' => $parent])->all();
        $result = [];
        foreach ($items as $key => $item) {
            $result[] = [
                'label' => $item->title,
                'url' => \Yii::$app->params['domain'] . '/c/' . $item->slug,
                'items' => $this->category($item->id)
            ];
        }
        return $result;
    }

    public function slide() {
        $model = Slide::find()->where(['status' => Slide::PUBLIC_ACTIVE])->all();
        return $model;
    }

    public function blog($limit) {
        $model = Blog::find()->where(['status' => Slide::PUBLIC_ACTIVE])->limit($limit)->all();
        return $model;
    }

}
