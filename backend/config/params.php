<?php
return [
    'adminEmail' => 'xannn94@yandex.com',
    'bsVersion'  => '4',
    'menu'       => [
        'main'     => [
            'title' => 'Панель Администратора',
            'url'   => '/site/index',
            'icon'  => ''
        ],
        'content'  => [
            'title' => 'Контент сайта',
            'icon'  => '',
            'items' => [
                'news'   => [
                    'title' => 'Новости',
                    'url'   => '/news/index',
                    'icon'  => '',
                ],
                'page'   => [
                    'title' => 'Страницы',
                    'url'   => '/page/index',
                    'icon'  => '',
                ],
                'menu'   => [
                    'title' => 'Меню',
                    'url'   => '/menu/index',
                    'icon'  => '',
                ],
                'widget' => [
                    'title' => 'Виджеты',
                    'url'   => '/widget/index',
                    'icon'  => '',
                ]
            ]
        ],
        'products' => [
            'title' => 'Каталог',
            'icon'  => '',
            'items' => [
                'category'     => [
                    'title' => 'Категории',
                    'url'   => '/category/index',
                    'icon'  => ''
                ],
                'product'      => [
                    'title' => 'Продукты',
                    'url'   => '/product/index',
                    'icon'  => ''
                ],
                'filter-group' => [
                    'title' => 'Группы фильтров',
                    'url'   => '/filter-group/index',
                    'icon'  => ''
                ],
                'filter'       => [
                    'title' => 'Фильтры',
                    'url'   => '/filter/index',
                    'icon'  => ''
                ]
            ]
        ],
        'settings' => [
            'title' => 'Настройки',
            'url'   => '/setting/index',
            'icon'  => ''
        ]
    ],
    'uploads' => [
        'news' => [
            'image' => [
                'rules' => '',
                'type' => 'image',
                'path' => 'uploads/news/'
            ]
        ]
    ]
];
