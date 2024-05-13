<?php   
return [
    'module' => [
        [
            'title' => 'QL sản phẩm',
            'icon' => 'fa fa-cube',
            'name' => ['product','attribute'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm sản phẩm',
                    'route' => 'product/catalogue/index'
                ],
                [
                    'title' => 'QL sản phẩm',
                    'route' => 'product/index'
                ],
                [
                    'title' => 'QL Loại thuộc tính',
                    'route' => 'attribute/catalogue/index'
                ],
                [
                    'title' => 'QL thuộc tính',
                    'route' => 'attribute/index'
                ],

            ]
        ],
        [
            'title' => 'QL Bài viết',
            'icon' => 'fa fa-file',
            'name' => ['post'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm Bài Viết',
                    'route' => 'post/catalogue/index'
                ],
                [
                    'title' => 'QL Bài Viết',
                    'route' => 'post/index'
                ]
            ]
        ],
        [
            'title' => 'QL Nhóm Thành Viên',
            'icon' => 'fa fa-user',
            'name' => ['user','permission'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm Thành Viên',
                    'route' => 'user/catalogue/index'
                ],
                [
                    'title' => 'QL Thành Viên',
                    'route' => 'user/index'
                ],
                [
                    'title' => 'QL Quyền',
                    'route' => 'permission/index'
                ]
            ]
        ],
        [
            'title' => 'QL Nhóm Khách hàng',
            'icon' => 'fa fa-users',
            'name' => ['customer'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm Khách hàng',
                    'route' => 'customer/catalogue/index'
                ],
                [
                    'title' => 'QL Khách hàng',
                    'route' => 'customer/index'
                ],
            ]
        ],
        [
            'title' => 'QL Banner & Slide',
            'icon' => 'fa fa-image',
            'name' => ['slide'],
            'subModule' => [
                [
                    'title' => 'Cài đặt Slide',
                    'route' => 'slide/index'
                ],
            ]
        ],
        [
            'title' => 'QL Maketing',
            'icon' => 'fa fa-money',
            'name' => ['promotion','source'],
            'subModule' => [
                [
                    'title' => 'QL khuyến mại',
                    'route' => 'promotion/index'
                ],
                [
                    'title' => 'QL Nguồn Khách',
                    'route' => 'source/index'
                ],
            ]
        ],
        [
            'title' => 'QL Menu',
            'icon' => 'fa fa-bars',
            'name' => ['menu'],
            'subModule' => [
                [
                    'title' => 'Cài đặt Menu',
                    'route' => 'menu/index'
                ],
            ]
        ],
        [
            'title' => 'Cấu hình chung',
            'icon' => 'fa fa-file',
            'name' => ['language','generate', 'system', 'widget'],
            'subModule' => [
                [
                    'title' => 'QL Ngôn ngữ',
                    'route' => 'language/index'
                ],
                // [
                //     'title' => 'QL Module',
                //     'route' => 'generate/index'
                // ],
                [
                    'title' => 'QL Widget',
                    'route' => 'widget/index'
                ],
                [
                    'title' => 'Cấu hình hệ thống',
                    'route' => 'system/index'
                ],
            ]
        ]
    ],
];
