<?php

namespace App\Services;

use App\Services\Interfaces\WidgetServiceInterface;
use App\Repositories\Interfaces\WidgetRepositoryInterface as WidgetRepository;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class WidgetService
 * @package App\Services
 */
class WidgetService extends BaseService implements WidgetServiceInterface
{
    protected $widgetRepository;
    protected $promotionRepository;
    protected $productService;

    protected $productCatalogueRepository;


    public function __construct(
        WidgetRepository $widgetRepository,
        PromotionRepository $promotionRepository,
        ProductCatalogueRepository $productCatalogueRepository,
        ProductService $productService
    ) {
        $this->widgetRepository = $widgetRepository;
        $this->promotionRepository = $promotionRepository;
        $this->productService = $productService;
        $this->productCatalogueRepository = $productCatalogueRepository;
    }



    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $perPage = $request->integer('perpage');
        $widgets = $this->widgetRepository->Pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'widget/index'],
        );

        // dd($widgets);


        return $widgets;
    }

    public function create($request, $languageId)
    {
        DB::beginTransaction();
        try {

            $payload = $request->only(['name', 'keyword', 'short_code', 'description', 'model', 'album']);
            $payload['model_id'] = $request->input('modelItem.id');
            $payload['description'] = [
                $languageId => $payload['description']
            ];
            $widget = $this->widgetRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();
            die();
            return false;
        }
    }


    public function update($id, $request, $languageId)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only(['name', 'keyword', 'short_code', 'description', 'model', 'album']);
            $payload['model_id'] = $request->input('modelItem.id');

            $payload['description'] = [
                $languageId => $payload['description']
            ];
            $widget = $this->widgetRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();
            die();
            return false;
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $widget = $this->widgetRepository->delete($id);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();
            die();
            return false;
        }
    }




    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'keyword',
            'short_code',
            'publish',
            'description'
        ];
    }


    /*FRONTEND SERVICE*/
    public function getWidget(array $params = [], int $language)
    {
        $whereIn = [];
        $whereInField = 'keyword';
        if (count($params)) {
            foreach ($params as $key => $val) {
                $whereIn[] = $val['keyword'];
            }
        }
        $widgets = $this->widgetRepository->getWidgetWhereIn($whereIn);
        if (!is_null($widgets)) {
            $temp = [];
            foreach ($widgets as $key => $widget) {
                $class = loadClass($widget->model);
                $agrument = $this->widgetAgrument($widget, $language, $params[$key]);
                $object = $class->findByCondition(...$agrument);
                $model = lcfirst(str_replace('Catalogue', '', $widget->model));
                if (count($object) && strpos($widget->model, 'Catalogue')) {
                    $clasRepo = loadClass(ucfirst($model));
                    $replace = $model . 's';
                    $service = $model . 'Service';
                    foreach ($object as $objectKey => $objectValue) {
                        if (isset($params[$key]['children']) && $params[$key]['children']) {

                            $childrenAgrument = $this->childrenAgrument([$objectValue->id], $language);
                            $objectValue->childrens = $class->findByCondition(...$childrenAgrument);
                        }
                        // -----------------LẤY SẢN PHẨM-----------------------
                        $childId = $class->recursiveCategory($objectValue->id, $model);
                        $ids = [];
                        foreach ($childId as $child_id) {
                            $ids[] = $child_id->id;
                        }
                        if ($objectValue->rgt - $objectValue->lft > 1) {

                            $objectValue->{$replace} = $clasRepo->findObjectByCategoryIds($ids, $model, $language);
                        }

                        if (isset($params[$key]['promotion']) && $params[$key]['promotion'] == true) {

                            $productId = $objectValue->{$replace}->pluck('id')->toArray();
                            $objectValue->{$replace} = $this->{$service}->combineProductAndPromotion($productId, $objectValue->{$replace});
                        }
                        $widgets[$key]->object = $object;
                    }
                } else {
                    $productId = $object->pluck('id')->toArray();
                    $object = $this->{$service}->combineProductAndPromotion($productId, $object);
                    $widget->object = $object;
                }
                $temp[$widget->keyword] = $widgets[$key];
            }
        }
        return $temp;
    }

    private function widgetAgrument($widget, $language, $param)
    {

        $relation = [
            'languages' => function ($query) use ($language) {
                $query->where('language_id', $language);
            }
        ];
        $withCount = [];
        if (strpos($widget->model, 'Catalogue')) {
            $model = lcfirst(str_replace('Catalogue', '', $widget->model)) . 's';
            if (isset($param['object'])) {
                $relation[$model] = function ($query) use ($param, $language) {

                    $query->with('languages', function ($query) use ($language) {
                        $query->where('language_id', $language);
                    });
                    $query->take(($param['limit'] ?? 8));
                    $query->orderBy('order', 'desc');
                };
            }
            if (isset($param['countObject'])) {
                $withCount[] = $model;
            }

        } else {
            $model = lcfirst($widget->model) . '_catalogues';
            $relation[$model] = function ($query) use ($language) {
                $query->with('languages', function ($query) use ($language) {
                    $query->where('language_id', $language);
                });
            };
        }
        return [
            'condition' => [
                config('apps.general.defaultPublish')
            ],
            'flag' => TRUE,
            'relation' => $relation,
            'param' => [
                    'whereIn' => $widget->model_id,
                    'whereInField' => 'id',
                ],
            'withCount' => $withCount
        ];
    }

    private function childrenAgrument($objectId, $language)
    {
        return [
            'condition' => [
                config('apps.general.defaultPublish')
            ],
            'flag' => true,
            'relation' => [
                    'languages' => function ($query) use ($language) {
                        $query->where('language_id', $language);
                    }
                ],
            'param' => [
                'whereIn' => $objectId,
                'whereInField' => 'parent_id'
            ]
        ];
    }

}
