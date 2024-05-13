<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\system;
use App\Services\Interfaces\SystemServiceInterface  as SystemService;
use App\Repositories\Interfaces\SystemRepositoryInterface  as SystemRepository;
use App\Models\Language;

class SystemController extends Controller
{
    protected $systemLibary;
    protected $systemService;
    protected $systemRepository;
    protected $language;
    
    public function __construct(System $systemLibary, SystemService $systemService, SystemRepository $systemRepository){

        $this->middleware(function($request, $next){
            $locale = app()->getLocale(); // vn en cn
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language->id;
            return $next($request);
        });

        $this -> systemLibary = $systemLibary;
        $this -> systemService = $systemService;
        $this -> systemRepository = $systemRepository;
    }

    public function index(){
    
        $config = $this->config();
        $systemConfig = $this->systemLibary->config();
        $systems = convert_array($this->systemRepository->findByCondition(
            [
                ['language_id' ,'=', $this -> language]
            ],TRUE
        ), 'keyword', 'content') ;


        $config['seo'] = __('messages.system');
        $template = 'backend.system.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'systemConfig',
            'systems'
        ));
    }
    public function store(Request $request){
        if($this->systemService->save($request, $this->language)){
            return redirect()->route('system.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('system.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function translate($languageId = 0){
    
        $config = $this->config();
        $systemConfig = $this->systemLibary->config();
        $systems = convert_array($this->systemRepository->findByCondition(
            [
                ['language_id' ,'=', $languageId]
            ],TRUE
        ), 'keyword', 'content') ;
        $config['seo'] = __('messages.system');
        $config['method'] = 'translate';
        $template = 'backend.system.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'systemConfig',
            'systems',
            'languageId'
        ));
    }


    public function saveTranslate(Request $request, $languageId){
        if($this->systemService->save($request,$languageId)){
            return redirect()->route('system.translate', ['languageId' => $languageId])->with('success','Thêm mới bản ghi thành công');
        }
    }

    
    private function config(){
        return [
            'js' => [
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
                'backend/plugins/ckeditor/ckeditor.js',
            ]
        ];
    }

}
