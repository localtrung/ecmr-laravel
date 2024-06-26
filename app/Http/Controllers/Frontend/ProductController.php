<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;

use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use App\Models\System;
use Illuminate\Http\Request;


class ProductController extends FrontendController
{
    protected $language;
    protected $productCatalogueRepository;
    protected $productRepository;
    protected $productService;
    public function __construct(
        ProductCatalogueRepository $productCatalogueRepository,
        ProductRepository $productRepository,
        ProductService $productService,
    )
    {
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->productRepository = $productRepository;
        $this->productService = $productService;
        parent::__construct();
    }

    public function index($id,  $request)
    {
        $product = $this->productRepository->getProductById($id, $this->language);
        $product = $this->productService->combineProductAndPromotion([$id], $product, true);
        $productCatalogue = $this->productCatalogueRepository->getProductCatalogueById($product->product_catalogue_id, $this->language);
        $breadcrumb = $this->productCatalogueRepository->breadcrumb($productCatalogue, $this->language);
        $system = $this->system;

        $product = $this->productService->getAttribute($product, $this->language); 
        $config = $this->config();
        $seo = seo($product);
        return view(
            'frontend.product.product.index',
            compact(
                'config',
                'system',
                'seo',
                'breadcrumb',
                'productCatalogue',
                'product',
            )
        );
    }

    public function config(){
        return [
            'language' => $this->language
        ];
    }

}