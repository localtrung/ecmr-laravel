<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Repositories\Interfaces\SlideRepositoryInterface  as SlideRepository;
use App\Services\Interfaces\WidgetServiceInterface  as WidgetService;


use Illuminate\Http\Request;


class HomeController extends FrontendController
{
    protected $slideRepository;

    protected $systemRepository;
    protected $widgetService;
    public function __construct( 
        SlideRepository $slideRepository,
        WidgetService $widgetService,

        ){
        $this->slideRepository = $slideRepository;
        $this->widgetService = $widgetService;

        parent::__construct();
    }

    public function index(){

        $widget = [
            'category' => $this->widgetService->findWidgetByKeyword('category', $this->language, ['children' => true ])
        ];
        $slides = $this->slideRepository->findByCondition(...$this->slideAgrument());
        $slides-> slideItems = $slides->item[$this->language];
        $config = $this->config();
        return view('frontend.homepage.home.index', compact(
            'config',
            'slides',
        ));
    }

    private function slideAgrument(){
        return [
            'condition' =>[
                config('apps.general.defaultPublish'),
                ['keyword', '=', 'slide-index']
            ]
            ];
    }
    private function config(){
        return [];
    }


}
