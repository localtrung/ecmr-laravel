<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Str;


class DashboardController extends Controller
{

    protected $language;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $locale = app()->getLocale(); // vn en 
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language->id;
            return $next($request);
        });
    }

    public function changeStatus(Request $request)
    {
        $post = $request->input();
        $serviceInterfaceNamespace = '\App\Services\\' . ucfirst($post['model']) . 'Service';
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        $flag = $serviceInstance->updateStatus($post);

        return response()->json(['flag' => $flag]);

    }

    public function changeStatusAll(Request $request)
    {
        $post = $request->input();
        $serviceInterfaceNamespace = '\App\Services\\' . ucfirst($post['model']) . 'Service';
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        $flag = $serviceInstance->updateStatusAll($post);
        return response()->json(['flag' => $flag]);

    }

    public function getMenu(Request $request)
    {
        $model = $request->input('model');
        $page = ($request->input('page')) ?? 1;
        $keyword = ($request->string('keyword')) ?? null;
        $serviceInterfaceNamespace = '\App\Repositories\\' . ucfirst($model) . 'Repository';
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        $agruments = $this->paginationAgrument($model, $keyword);
        $object = $serviceInstance->pagination(...array_values($agruments));

        return response()->json($object);
    }

    private function paginationAgrument(string $model = '', string $keyword): array
    {
        $model = Str::snake($model);
        $join = [
            [$model . '_language as tb2', 'tb2.' . $model . '_id', '=', $model . 's.id'],
        ];
        if (strpos($model, '_catalogue') === false) {
            $join[] = ['' . $model . '_catalogue_' . $model . ' as tb3', '' . $model . 's.id', '=', 'tb3.' . $model . '_id'];

        }
        $conditon = [
            'where' => [
                ['tb2.language_id', '=', $this->language],
            ]
        ];
        if (!is_null($keyword)) {
            $conditon['keyword'] = addslashes($keyword);
        }
        return [
            'select' => ['id', 'name', 'canonical'],
            'condition' => $conditon,
            'perpage' => 20,
            'paginationConfig' => [
                'path' => $model . '.index',
                'groupBy' => ['id', 'name']
            ],
            'orderBy' => [$model . 's.id', 'DESC'],
            'join' => $join,
            'relation' => [],
        ];
    }

    public function findModelObject(Request $request)
    {
        $get = $request->input();
        $alias = Str::snake($get['model']) . '_language';
        // $class = $this->loadClassInterface($get['model'], 'Repository');
        $serviceInterfaceNamespace = '\App\Repositories\\' . ucfirst($get['model']) . 'Repository';
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        $object = $serviceInstance->findWidgetItem([
            ['name', 'LIKE', '%' . $get['keyword'] . '%'],
        ], $this->language, $alias);
        return response()->json($object);

    }


    // private function loadClassInterface(string $model = '' , $interface = 'Repository') {
    //     $serviceInterfaceNamespace = '\App\Repositories\\' . ucfirst($model) . $interface;
    //     if(class_exists($serviceInterfaceNamespace)) {
    //         $serviceInstance = app($serviceInterfaceNamespace);  
    //     }
    //     return $serviceInstance;
    // }

    public function getPromotionConditionValue(Request $request)
    {
        try {
            $get = $request -> input();
            switch ($get['value']) {
                case 'staff_take_care_customer':
                    $class = loadClass('User');
                    $object = $class->all()->toArray();
                    break;
                case 'customer_group':
                    $class = loadClass('CustomerCatalogue');
                    $object = $class->all()->toArray();
                    break;
                case 'customer_gender':
                    $object = __('module.gender');
                    break;
                case 'customer_birthday':
                    $object = __('module.day');
                    break;

            }

            $temp = [];
            if (!is_null($object) && count($object)) {
                foreach ($object as $key => $val) {
                    $temp[] = [
                        'id' => $val['id'],
                        'text' => $val['name']
                    ];
                }
            }
            return response()->json([
                'data' => $temp,
                'error' => false,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'messages' => $e->getMessage(),
                'status' => 400
            ]);
        }

    }





}
