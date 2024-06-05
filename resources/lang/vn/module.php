<?php

return [
    'model' => [
        'PostCatalogue' => 'Nhóm vài viết',
        'Post' => 'Bài viết',
        'ProductCatalogue' => 'Nhóm sản phẩm',
        'product' => 'Sản phẩm',
    ],
    'type' => [
        'dropdown-menu' => 'Dropdown Menu',
        'mega-menu' => 'Mega Menu'
    ],
    'effect' => [
        'fade' => 'Fade',
        'cube' => 'Cube',
        'overflow' => 'Overflow',
        'flip' => 'Flip',
        'cards' => 'Cards',
        'creative' => 'Creative',
    ],
    'navigate' => [
        'hide' => 'Ẩn',
        'dots' => 'Dấu chấm',
        'thumbnails' => 'Ảnh thumbnails'
    ],

    'promotion' => [
        'order_amount_range' => 'Chiết khấu theo tổng giá trị đơn hàng',
        'product_and_quantity' => 'Chiết khấu theo từng sản phẩm',

    ]
    ,
    'item' => [
        'Product' => 'Phiên bản sản phẩm',
        'ProductCatalogue' => 'Loại sản phẩm',
    ]
    ,
    'gender' => [
        [
            'id' => 1,
            'name' => 'Nam'
        ],
        [
            'id' => 2,
            'name' => 'Nữ'
        ]
    ],
    'day' => array_map(function ($value) {
        return ['id' => $value - 1, 'name' => $value];
    }, range(1, 31)),
    'applyStatus' => [
        [
            'id' => 'staff_take_care_customer',
            'name' => 'Nhân viên phụ trách'
        ],
        [
            'id' => 'customer_group',
            'name' => 'Nhóm khách hàng'
        ],

        [
            'id' => 'customer_gender',
            'name' => 'Giới tính'
        ],
        [
            'id' => 'customer_birthday',
            'name' => 'Ngày sinh'
        ]
    ],
];