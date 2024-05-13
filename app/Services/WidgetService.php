<?php

namespace App\Services;

use App\Services\Interfaces\WidgetServiceInterface;
use App\Repositories\Interfaces\WidgetRepositoryInterface as WidgetRepository;
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


    public function __construct(
        WidgetRepository $widgetRepository
    ) {
        $this->widgetRepository = $widgetRepository;
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

    public function findWidgetByKeyword(string $keyword = '', int $language = 1, $param = [])
    {
        $widget = $this->widgetRepository->findByCondition([
            ['keyword', '=', $keyword],
            config('apps.general.defaultPublish')
        ]);

        if(!is_null($widget))
        {
            $loadClass = loadClass($widget->model);
            $object = $loadClass->findByCondition(...$this->widgetAgrument($widget, $language, $param));
        }
    }

    private function widgetAgrument($widget, $language, $param)
    {

        $relation = [
            'languages' => function ($query) use ($language) {
                $query->where('language_id', $language);
            }
        ];

        $withCount = [];

        if (strpos($widget->model, 'Catalogue') && isset($param['children'])) {
            $model = lcfirst(str_replace('Catalogue', '', $widget->model)) . 's';
            $relation[$model] = function ($query) use ($param, $language) {
                $query->limit($param['limit'] ?? 8);
                $query->where('publish', 2);
                $query->with('languages', function ($query) use ($language) {
                    $query->where('language_id', $language);
                });
            };

            $withCount[] = $model;      
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
}
