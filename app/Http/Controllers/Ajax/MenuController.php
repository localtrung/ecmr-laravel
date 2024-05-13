<?php

namespace App\Http\Controllers\Ajax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuCatalogueRequest;
use App\Repositories\Interfaces\MenuRepositoryInterface  as MenuRepository;
use App\Services\Interfaces\MenuCatalogueServiceInterface  as MenuCatalogueService;
use App\Services\Interfaces\MenuServiceInterface  as MenuService;
use App\Models\Language;


class MenuController extends Controller
{
    protected $menuRepository;
    protected $language;

    protected $menuService;

    public function __construct(
        MenuRepository $menuRepository,
        MenuCatalogueService $menuCatalogueService,
        MenuService $menuService
    ){

        $this->middleware(function ($request, $next) {
            $locale = app()->getLocale(); // vn en cn
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language->id;
            return $next($request);
        });
        $this->menuRepository = $menuRepository;
        $this->menuCatalogueService = $menuCatalogueService;
        $this->menuService = $menuService;
        
    }

    public function createCatalogue(StoreMenuCatalogueRequest $request){
        $menuCatalogue = $this->menuCatalogueService->create($request);
        if( $menuCatalogue != FALSE){
            return response()->json([
            'message' => 'Tạo nhóm menu thành công',
            'code' => '0',
            'data' => $menuCatalogue
            ]);
        }
        return response()->json([
            'message' => 'Sai chỗ nào rồi, xin hãy thử lại',
            'code' => '1'
        ]);
    }

    public function drag(Request $request)
    {
       $json = json_decode($request->input('json'), TRUE);
       $menuCatalogueId = $request->integer('menu_catalogue_id');

       $flag = $this ->menuService->dragUpdate($json, $menuCatalogueId, $this->language);
    }
}