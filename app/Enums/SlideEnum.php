<?php
namespace App\Enums;

enum SlideEnum: string
{
    const BANNER = 'banner';
    const MAIN_SLIDE = 'slide-index';

    public static function toArray(){
        return [
            self::BANNER=>'banner',
            self::MAIN_SLIDE => 'slide-index'
        ];
    }
}