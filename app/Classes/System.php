<?php
namespace App\Classes;

class system{
    public function config(){
        $data['homepage'] =[
            'label' => 'Thông tin chung',
            'description' => 'Cài đặt đầy đủ thông tin chung của website.
                              Tên thương hiệu của website, Logo, Favicon, vv...',
            'value' => [
                'company' => ['type' => 'text', 'label' => 'Tên công ty'],
                'brand' => ['type' => 'text', 'label' => 'Tên thương hiệu'],
                'slogan' => ['type' => 'text', 'label' => 'Slogan'],
                'logo' => ['type' => 'images', 'label' => 'Logo Website', 'tilte' => 'Click vào ô phía dưới để tải logo'],
                'favicon' => ['type' => 'images', 'label' => 'Favicon','tilte' => 'Click vào ô phía dưới để tải favicon cho website'],
                'copyright' => ['type' => 'text', 'label' => 'Copyright'],
                'website' => ['type' => 'select', 'label' => 'Tình trạng website', 'option' => [
                    'open' => 'Mở cửa website',
                    'close' => 'Website bảo trì'
                ]],
                'short_intro' => ['type' => 'editor', 'label' => 'Giới thiệu ngắn'],

            ]
        ];
        $data['contact'] =[
            'label' => 'Thông tin liên hệ',
            'description' => 'Cài đặt thông tin liên hệ của Website',
            'value' => [
                'office' => ['type' => 'text', 'label' => 'Địa chỉ công ty'],
                'address' => ['type' => 'text', 'label' => 'Văn phòng'],
                'hotline' => ['type' => 'text', 'label' => 'Hotline'],
                'technical_phone' => ['type' => 'text', 'label' => 'Hotline Hỗ trợ'],
                'sell_phone' => ['type' => 'text', 'label' => 'Hotline kinh doanh'],
                'phone' => ['type' => 'text', 'label' => 'Số cố định'],
                'fax' => ['type' => 'text', 'label' => 'Fax'],
                'email' => ['type' => 'text', 'label' => 'Email'],
                'tax' => ['type' => 'text', 'label' => 'Mã số thuế'],
                'website' => ['type' => 'text', 'label' => 'Website'],
                'map' => ['type' => 'textarea', 'label' => 'Bản đồ' , 
                            'link' => [
                                'text' => 'Hướng dẫn thiết lập bản đồ', 
                                'href' => 'https://manhan.vn/hoc-website-nang-cao/huong-dan-nhung-ban-do-vao-website/',
                                'target' => '_blank'
                                ]
                            ],
            ]
        ];

        $data['seo'] =[
            'label' => 'Cấu hình SEO dành cho trang chủ',
            'description' => 'Cài đặt đầy đủ thông tin SEO của website.
                              Bao gồm tiêu đề SEO, Từ khóa SEO, vv...',
            'value' => [
                'meta_title' => ['type' => 'text', 'label' => 'Tiêu đề SEO'],
                'meta_keyword' => ['type' => 'text', 'label' => 'Từ khóa SEO'],
                'meta_description' => ['type' => 'text', 'label' => 'Mô tả SEO'],
                'meta_images' => ['type' => 'images', 'label' => 'Ảnh SEO'],
                ],

            ];
        

        return $data;
    }
}
