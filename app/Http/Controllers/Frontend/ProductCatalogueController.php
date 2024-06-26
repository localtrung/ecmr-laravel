<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;

use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use App\Models\System;
use Illuminate\Http\Request;


class ProductCatalogueController extends FrontendController
{
    protected $language;
    protected $productCatalogueRepository;
    protected $productService;
    public function __construct(
        ProductCatalogueRepository $productCatalogueRepository,
        ProductService $productService,
    )
    {
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->productService = $productService;
        parent::__construct();
    }

    public function index($id,  $request, $page = 1)
    {
        $productCatalogue = $this->productCatalogueRepository->getProductCatalogueById($id, $this->language);
        $breadcrumb = $this->productCatalogueRepository->breadCrumb($productCatalogue, $this->language);
        $products = $this->productService->paginate(
            $request, 
            $this->language, 
            $productCatalogue, 
            ['path' => $productCatalogue->canonical],
            $page,
        );
        $productId = $products->pluck('id')->toArray();
        if(count($productId) && !is_null($productId))
        {
            $products = $this->productService->combineProductAndPromotion($productId, $products);
        }
        $system = $this->system;
        $config = $this->config();
        $seo = seo($productCatalogue, $page);
        return view(
            'frontend.product.catalogue.index',
            compact(
                'config',
                'system',
                'seo',
                'productCatalogue',
                'breadcrumb',
                'products',
            )
        );
    }

    public function config(){
        return [
            'language' => $this->language
        ];
    }

}