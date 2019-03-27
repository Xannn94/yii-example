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
                'product-category'     => [
                    'title' => 'Категории',
                    'url'   => '/product-category/index',
                    'icon'  => ''
                ],
                'product'              => [
                    'title' => 'Продукты',
                    'url'   => '/product/index',
                    'icon'  => ''
                ],
                'product-filter-group' => [
                    'title' => 'Группы фильтров',
                    'url'   => '/product-filter-group/index',
                    'icon'  => ''
                ],
                'product-filter'       => [
                    'title' => 'Фильтры',
                    'url'   => '/product-filter/index',
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
    'uploads'    => [
        'news' => [
            'image' => [
                'rules' => '',
                'type'  => 'image',
                'path'  => 'uploads/news/'
            ]
        ]
    ]
];
