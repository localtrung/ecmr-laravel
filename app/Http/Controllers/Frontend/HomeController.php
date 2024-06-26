<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Repositories\Interfaces\SlideRepositoryInterface as SlideRepository;
use App\Services\Interfaces\WidgetServiceInterface as WidgetService;
use App\Services\Interfaces\SlideServiceInterface as SlideService;
use App\Enums\SlideEnum;


use Illuminate\Http\Request;


class HomeController extends FrontendController
{
    protected $slideRepository;

    protected $systemRepository;
    protected $widgetService;
    protected $slideService;
    public function __construct(
        SlideRepository $slideRepository,
        WidgetService $widgetService,
        SlideService $slideService,

    ) {
        $this->slideRepository = $slideRepository;
        $this->widgetService = $widgetService;
        $this->slideService = $slideService;

        parent::__construct();
    }

    public function index()
    {

        $widgets = $this->widgetService->getWidget(
            [
              
                ['keyword' => 'category-high'],
                ['keyword' => 'category-home', 'children' => true,'promotion' => true],
                ['keyword' => 'category', 'children' => true, 'countObject' => true],
                ['keyword' => 'Best_Seler'],
            ],
            $this->language
        );
        $slides = $this->slideService->getSlide([SlideEnum::BANNER, SlideEnum::MAIN_SLIDE], $this->language);
        $config = $this->config();
        $system = $this->system;
        $seo = [
            'meta_title' => $system['seo_meta_title'],
            'meta_keyword' => $system['seo_meta_keyword'],
            'meta_description' => $system['seo_meta_description'],
            'meta_image' => $system['seo_meta_images'],
            'canonical' => config('app.url')
        ];
        return view('frontend.homepage.home.index', compact(
            'config',
            'slides',
            'widgets',
            'system',
            'seo',
        )
        );
    }

    private function config()
    {
        return [
            'language' => $this->language
        ];
    }


}
