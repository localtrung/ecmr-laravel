<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Base;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(
        Model $model
    ) {
        $this->model = $model;
    }

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        int $perPage = 1,
        array $extend = [],
        array $orderBy = ['id', 'DESC'],
        array $join = [],
        array $relations = [],
        array $rawQuery = []

    ) {
        $query = $this->model->select($column);
        return $query
            ->keyword($condition['keyword'] ?? null)
            ->publish($condition['publish'] ?? null)
            ->relationCount($relations ?? null)
            ->CustomWhere($condition['where'] ?? null)
            ->customWhereRaw($rawQuery['whereRaw'] ?? null)
            ->customJoin($join ?? null)
            ->customGroupBy($extend['groupBy'] ?? null)
            ->customOrderBy($orderBy ?? null)
            ->paginate($perPage)
            ->withQueryString()->withPath(env('APP_URL') . $extend['path']);
    }

    public function create(array $payload = [])
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function createBatch(array $payload = [])
    {
        return $this->model->insert($payload);
    }

    public function update(int $id = 0, array $payload = [])
    {
        $model = $this->findById($id);
        $model->fill($payload);
        $model->save();
        return $model;
    }

    public function updateOrInsert(array $payload = [], array $condition = [])
    {
        return $this->model->updateOrInsert($condition, $payload);
    }

    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = [])
    {
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }

    public function updateByWhere($condition = [], array $payload = [])
    {
        $query = $this->model->newQuery();
        foreach ($condition as $key => $val) {
            $query->where($val[0], $val[1], $val[2]);
        }
        return $query->update($payload);
    }


    public function delete(int $id = 0)
    {
        return $this->findById($id)->delete();
    }

    public function forceDelete(int $id = 0)
    {
        return $this->findById($id)->forceDelete();
    }

    public function forceDeleteByCondition(array $condition = [])
    {
        $query = $this->model->newQuery();
        foreach ($condition as $key => $val) {
            $query->where($val[0], $val[1], $val[2]);
        }
        return $query->forceDelete();
    }

    public function all(array $relation = [])
    {
        return $this->model->with($relation)->get();
    }

    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
    ) {
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }

    public function findByCondition(
        $condition = [],
        $flag = false,
        $relation = [],
        array $orderBy = ['id', 'desc'],
        array $param = [],
        array $withCount = []
    ) {
        $query = $this->model->newQuery();
        foreach ($condition as $key => $val) {
            $query->where($val[0], $val[1], $val[2]);
        }

        if (isset($param['whereIn'])) {
            $query->whereIn($param['whereInField'], $param['whereIn']);
        }

        $query->with($relation);
        $query->withCount($withCount);
        $query->orderBy($orderBy[0], $orderBy[1]);
        return ($flag == false) ? $query->first() : $query->get();
    }

    public function findByWhereHas(array $condition = [], string $relation = '', string $alias = '')
    {
        return $this->model->with('languages')->whereHas($relation, function ($query) use ($condition, $alias) {

            foreach ($condition as $key => $val) {
                $query->where($alias . '.' . $key, $val);
            }
        })->first();
    }

    public function createPivot($model, array $payload = [], string $relation = '')
    {
        return $model->{$relation}()->attach($model->id, $payload);
    }

    public function findWidgetItem(array $condition = [], int $language_id = 1, string $alias = '')
    {
        return $this->model->with([
            'languages' => function ($query) use ($language_id) {
                $query->where('language_id', $language_id);
            }
        ])
            ->whereHas('languages', function ($query) use ($condition, $alias) {
                foreach ($condition as $key => $val) {
                    $query->where($alias . '.' . $val[0], $val[1], $val[2]);
                }
            })->get();
    }

    public function recursiveCategory(string $parameter = '', $table = '' ){
        $table = $table.'_catalogues';
        $query = "
            WITH RECURSIVE category_tree AS (
                SELECT id, parent_id, deleted_at
                FROM $table
                WHERE id IN (?)
                UNION ALL 
                SELECT c.id, c.parent_id, c.deleted_at
                FROM $table as c
                JOIN category_tree AS ct ON ct.id = c.parent_id
            )

            SELECT id FROM category_tree WHERE deleted_at IS NULL
        ";

        $result = DB::select($query, [$parameter]);
        return $result;
    }

    public function findObjectByCategoryIds($catId = [], $model, $language){
        $query = $this->model->newQuery();
        $this -> model->select(
            $model.'s.*',
        )
        ->where(
            [config('apps.general.defaultPublish')]
        )
        ->with('languages', function($query) use ($language)
        {
            $query->where('language_id', $language);
        })
        ->with($model.'_catalogues',function($query) use ($language)
        {
            $query->with('languages',function($query) use ($language){
                $query->where('language_id', $language);
            });
        });
        if($model == 'product')
        {
            $query->with('product_variants');
        }
        $query->join($model.'_catalogue_'.$model.' as tb2', 'tb2.'.$model.'_id', '=', $model.'s.id')
        ->whereIn('tb2.'.$model.'_catalogue_id', $catId)
        ->orderBy('order','desc')
        ->limit(8)
        ->get()
        ;
        return $query->get();
    }



}
