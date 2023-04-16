<?php

namespace App\Repositories;

use App\Traits\TrashTrait;
use App\Traits\ConditionBuilderTrait;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
abstract class BaseRepository
{
    use TrashTrait;
    use ConditionBuilderTrait;

    /**
     * @var Model
     */
    protected $model;
    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     *
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    /**
     * Configure the Model
     *
     * @return string
     */
    abstract public function model();

    /**
     * Make Model instance
     *
     * @return Model
     * @throws \Exception
     *
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }


    /**
     * Paginate records for scaffold.
     *
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, $columns = ['*'])
    {
        $query = $this->allQuery();
        return $query->paginate($perPage, $columns);
    }


    /**
     * Build a query for retrieving all records.
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function allQuery($search = [], $skip = null, $limit = null)
    {

        $query = $this->model->newQuery();
        if (count($search) > 0) {
            foreach ($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    if (isset($this->model->searchConfig) && !is_array($value) && array_key_exists($key, $this->model->searchConfig) && !empty
                        ($this->model->searchConfig[$key])) {
                        $condition = $this->model->searchConfig[$key] == 'like' || $this->model->searchConfig[$key] == 'LIKE';
                        $query->where($key, $this->model->searchConfig[$key], $condition ? '%' . $value . '%' : $value);
                    } else {
                        if (is_array($value)) {
                            $query->whereIn($key, $value);
                        } elseif (strpos($value, ',') !== false) {
                            $query->whereIn($key, explode(',', $value));
                        } else {
                            $query->where($key, $value);
                        }
                    }
                }
            }
        }
        if (!is_null($skip)) {
            $query->skip($skip);
        }
        if (!is_null($limit)) {
            $query->limit($limit);
        }
        return $query;
    }


    /**
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all($search = [], $skip = null, $limit = null, $columns = ['*'],
                        $withRelations = [], $whereInRelation = [], $recursiveRel = [], $trashed = false
        , $pluck = [], $moreConditionForFirstLevel = [], $paginate = '', $orderBy = [], $appendPerPage = [])
    {
        if ($pluck != []) {
            $columns = [];
        }
        $query = $this->allQuery($search, $skip, $limit);


        if ($withRelations != []) {
            $query = $this->addRelationsToQuery($query, $withRelations, $whereInRelation);
        }

        if ($recursiveRel != []) {
            $query = $this->addRecursiveRelationsToQuery($query, $recursiveRel);
        }
        if ($pluck != []) {
            return $query->pluck($pluck[0], $pluck[1]);
        }
        if ($trashed && $trashed !== 'withTrashed') {
            $query = $query->onlyTrashed();
        } elseif ($trashed == 'withTrashed') {
            $query = $query->withTrashed();
        }
        if (!empty($orderBy)) {
            $query = $query->orderBy($orderBy['column'], $orderBy['order']);
        }
        if ($moreConditionForFirstLevel){
            if ( count($moreConditionForFirstLevel) == 1){
                $query = self::proccessQuery($query, $moreConditionForFirstLevel);
            } else {
                foreach ($moreConditionForFirstLevel as $key => $value){
                    $query = self::proccessQuery($query, [$key => $value]);
                }
            }
        }

        if($paginate && $appendPerPage){
            return $query->paginate($paginate)->appends($appendPerPage);
        }
        elseif ($paginate){
            return $query->paginate($paginate);
        }
        else{
            return $query->get($columns);
        }
    }


    public function updateMultiRaws($data, $ids, $column = 'id')
    {
        $query = $this->model->newQuery();
        return $query->whereIn($column, $ids)->update($data);
    }

    /**
     * Retrieve all records relations
     *
     * @param array $model
     * @param int|null $Relations
     * @param int|null $whereInRelation
     * return query with his relations
     */
    public function addRelationsToQuery($query, $withRelations, $whereInRelation)
    {
        foreach ($withRelations as $rel) {
            $query->with($rel);
        }
        return $query;
    }

    public function addRecursiveRelationsToQuery($query, $withRecursive)
    {
        foreach ($withRecursive as $key => $value) {
            if (!isset($value['type']) || $value['type'] == 'normal') {
                $query = $query->with([$key => function ($q) use ($key, $value) {
                    $q = self::proccessQuery($q, $value);
                    if (isset($value['recursive']) && count($value['recursive']) > 0)
                        $this->addRecursiveRelationsToQuery($q, $value['recursive']);
                }]);
            } elseif ($value['type'] == 'withCount') {
                $query = $query->withCount([$key => function ($q) use ($key, $value) {
                    $q = self::proccessQuery($q, $value);
                    if (isset($value['recursive']) && count($value['recursive']) > 0)
                        $this->addRecursiveRelationsToQuery($q, $value['recursive']);
                }]);
            } elseif ($value['type'] == 'whereHas') {// use relation whereHas
                $query = $query->whereHas($key, function ($q) use ($key, $value) {
                    $q = self::proccessQuery($q, $value);
                    if (isset($value['recursive']) && count($value['recursive']) > 0)
                        $this->addRecursiveRelationsToQuery($q, $value['recursive']);
                });
            } elseif (in_array($value['type'], ['whereDoesntHave', 'orWhereDoesntHave'])) {// use relation doesntHave
                $query = $query->{$value['type']}($key, function ($q) use ($key, $value) {
                    $q = self::proccessQuery($q, $value);
                    if (isset($value['recursive']) && count($value['recursive']) > 0)
                        $this->addRecursiveRelationsToQuery($q, $value['recursive']);
                });
            } elseif ($value['type'] == 'orWhereHas') {// use relation whereHas
                $query = $query->orWhereHas($key, function ($q) use ($key, $value) {
                    $q = self::proccessQuery($q, $value);
                    if (isset($value['recursive']) && count($value['recursive']) > 0)
                        $this->addRecursiveRelationsToQuery($q, $value['recursive']);
                });
            } elseif ($value['type'] == 'whereHasWith') {
                if (isset($value['countWhereHas']) && $value['countWhereHas'] != '')
                    $query = $query->whereHas($key, function ($q) use ($key, $value) {
                        $q = self::proccessQuery($q, $value);
                    }, '>=', $value['countWhereHas']);
                else
                    $query = $query->whereHas($key, function ($q) use ($key, $value) {
                        $q = self::proccessQuery($q, $value);
                    });
                $query = $query->with([$key => function ($q) use ($key, $value) {
                    if (isset($value['recursive']) && count($value['recursive']) > 0)
                        $this->addRecursiveRelationsToQuery($q, $value['recursive']);
                }]);
            } elseif ($value['type'] == 'leftJoin') {// use relation LeftJoin
                $query = $query->LeftJoin($key, function ($q) use ($value) {
                    $q = self::proccessQuery($q, $value, 'leftJoin');
                    if (isset($value['recursive']) && count($value['recursive']) > 0)
                        $this->addRecursiveRelationsToQuery($q, $value['recursive']);
                });
                if ($value['columns'])
                    $query = $query->select($value['columns']);
            } elseif ($value['type'] == 'join') {// use relation LeftJoin
                $query = $query->join($key, function ($q) use ($value) {
                    $q = self::proccessQuery($q, $value);
                    if (isset($value['recursive']) && count($value['recursive']) > 0)
                        $this->addRecursiveRelationsToQuery($q, $value['recursive']);
                });
                if ($value['columns'])
                    $query = $query->select($value['columns']);

                if (isset($value['groupBy']) && count($value['groupBy']) > 0) {
                    foreach ($value['groupBy'] as $where => $val) {
                        $query = $query->groupBy($val);
                    }
                }
                if (isset($value['orderByRaw']) && count($value['orderByRaw']) > 0) {
                    foreach ($value['orderByRaw'] as $where => $val) {
                        $query = $query->orderByRaw($val);
                    }
                }
            } elseif (in_array($value['type'], ['whereHasMorph', 'orWhereHasMorph'])) {
                $query = $query->{$value['type']}($key, '*', function ($q, $type) use ($key, $value) {
                    $q = self::proccessQuery($q, $value);
                    if (isset($value['recursive']) && count($value['recursive']) > 0)
                        $this->addRecursiveRelationsToQuery($q, $value['recursive']);
                });
            }
            elseif ($value['type'] == 'closure' ) {
                $query = $query->where(function($q)use($value, $key){
                    $q->{$value['first_query']}($key, function($q)use($value, $key){
                        $q->whereIn('inventory_tag_id', $value['whereIn']['inventory_tag_id']);
                    })->{$value['secound_query']}($key);
                });
            }

        }
        return $query;
    }

    public function whereNotNull($q, $values)
    {
        $num = 0;
        foreach ($values as $column) {
            if ($num == 0)
                $q->whereNotNull($column);
            else
                $q->orWhereNotNull($column);
            $num++;
        }
        return $q;
    }

    public function proccessWhere($q, $key, $value)
    {
        if (is_array($value) && count($value) == 2)
            $q->where($key, $value[0], $value[1]);
        else
            $q->where($key, $value);
        return $q;
    }

    public function proccessOrWhere($q, $key, $value)
    {
        if (is_array($value) && count($value) == 2)
            $q->orWhere($key, $value[0], $value[1]);
        else
            $q->orWhere($key, $value);
        return $q;
    }

    public function proccessOrWhereNull($query, $val)
    {
        return $query->orWhereNull($val);
    }

    public function proccessQuery($q, $values, $test = '')
    {
        if (isset($values['leftJoin']) && count($values['leftJoin']) > 0) {
            foreach ($values['leftJoin'] as $key => $value) {
                $q->on($key, '=', $value);
            }
        }
        if (isset($values['join']) && count($values['join']) > 0) {
            foreach ($values['join'] as $key => $value) {
                $q->on($key, '=', $value);
            }
        }
        if (isset($values['where']) && count($values['where']) > 0) {
            foreach ($values['where'] as $key => $value) {
                if (isset($this->model->searchConfig) && array_key_exists($key, $this->model->searchConfig) && !empty($this->model->searchConfig[$key])) {
                    $q->where($key, $this->model->searchConfig[$key], '%' . $value . '%');
                } else {
                    $q = $this->proccessWhere($q, $key, $value);
                }
            }
        }
        if (isset($values['whereBetween']) && count($values['whereBetween']) > 0) {
            foreach ($values['whereBetween'] as $key => $value) {
                    $q->whereBetween($key,[$value[0], $value[1]]);
            }
        }
        if (isset($values['orWhereBetween']) && count($values['orWhereBetween']) > 0) {
            foreach ($values['orWhereBetween'] as $key => $value) {
                $q->orwhereBetween($key,[$value[0], $value[1]]);
            }
        }
        if (isset($values['whereQuery']) && count($values['whereQuery']) > 0) {
            foreach ($values['whereQuery'] as $value) {
                $num = 0;
                $q->where(function ($query) use ($num, $value) {
                    foreach ($value as $k => $val) {
                        if ($num == 0) {
                            $query = $this->proccessWhere($query, $k, $val);
                        } else {
                            $query = $this->proccessOrWhere($query, $k, $val);
                        }
                        $num++;
                    }
                });
            }
        }
        if (isset($values['whereCustom']) && count($values['whereCustom']) > 0) {
            $num = 0;
            $q->where(function ($query) use ($num, $values) {
                foreach ($values['whereCustom'] as $ke => $value) {
                    foreach ($value as $valC) {
                        if (in_array($ke, ['whereDoesntHave', 'whereHasMorph', 'orWhereHasMorph', 'whereHas'])) {
                            $query = self::addRecursiveRelationsToQuery($query, $valC);
                        } else
                            foreach ($valC as $k => $val) {
                                if ($ke == 'where') {
                                    if ($num == 0)
                                        $query = $this->proccessWhere($query, $k, $val);
                                    else
                                        $query = $this->proccessOrWhere($query, $k, $val);
                                } elseif ($ke == 'orWhereNull') {
                                    $query = $this->proccessOrWhereNull($query, $val);
                                }
                                $num++;
                            }
                    }
                }
            });
        }
        if (isset($values['orWhereNotNull']) && count($values['orWhereNotNull']) > 0) {
            $q = $this->whereNotNull($q, $values['orWhereNotNull']);
        }
        if (isset($values['orWhereNull']) && count($values['orWhereNull']) > 0) {
            $num = 0;
            foreach ($values['orWhereNull'] as $column) {
                if ($num == 0)
                    $q->whereNull($column);
                else
                    $q->orWhereNull($column);
                $num++;
            }
        }
        if (isset($values['orWherePivot']) && count($values['orWherePivot']) > 0) {
            foreach ($values['orWherePivot'] as $where => $value) {
                $q->orWhere($where, $value);
            }
        }
        if (isset($values['whereIn']) && count($values['whereIn']) > 0) {
            foreach ($values['whereIn'] as $where => $value) {
                $q->whereIn($where, $value);
            }
        }
        if (isset($values['whereNotIn']) && count($values['whereNotIn']) > 0) {
            foreach ($values['whereNotIn'] as $where => $value) {
                $q->whereNotIn($where, $value);
            }
        }
        if (isset($values['orWhere']) && count($values['orWhere']) > 0) {
            $num = 0;
            foreach ($values['orWhere'] as $where => $value) {
                $q = $this->proccessOrWhere($q, $where, $value);
            }
        }
        if (isset($values['withCount']) && count($values['withCount']) > 0) {
            $num = 0;
            foreach ($values['withCount'] as $where => $value) {
                $q->withCount($value);
            }
        }
        if (isset($values['columns']) && count($values['columns']) > 0 && !isset($values['join']) && !isset($values['leftJoin'])) {
            $q->select($values['columns']);
        }
        if (isset($values['doesntHave']) && count($values['doesntHave']) > 0) {
            foreach ($values['doesntHave'] as $val) {
                $q->doesntHave($val);
            }
        }
        if (isset($values['groupBy']) && count($values['groupBy']) > 0) {
            foreach ($values['groupBy'] as $where => $value) {
                $q->groupBy($value);
            }
        }
        return $q;
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Model
     */
    public function create($input)
    {
        $model = $this->model->newInstance($input);
        $model->save();
        return $model;
    }

    /**
     * $model model used
     *
     * $data for sync
     *
     * $moreColumns more columns to push in pivot table
     * @return Model
     */
    public function syncRelation($model, $data, $moreColumns = [])
    {
        if ($moreColumns != []) {
            $pivotData = array_fill(0, count($data), $moreColumns);
            $data = array_combine($data, $pivotData);
        }
        $model = $model->sync($data);
        return $model;
    }

    public function attachRelation($model, $data, $moreColumns = [])
    {
        if ($moreColumns != []) {
            $pivotData = array_fill(0, count($data), $moreColumns);
            $data = array_combine($data, $pivotData);
        }
        $model = $model->attach($data);
        return $model;
    }

    /**
     * Find model record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, $columns = ['*'], $withRelations = [], $whereInRelation = [], $withRecursive = [], $trashed = false)
    {
        if (is_a($this->model , 'Sales\Models\Lead'))
        {
            $query = $this->model->withoutGlobalScopes(['Sales\Scopes\DefaulSalesManScope', 'Sales\Scopes\WithoutColdStateLeads'])->newQuery();
        }else{
            $query = $this->model->newQuery();
        }

        if ($withRelations != []) {
            $query = $this->addRelationsToQuery($query, $withRelations, $whereInRelation);
        }
        if ($withRecursive != []) {
            $query = $this->addRecursiveRelationsToQuery($query, $withRecursive);
        }
        if ($trashed) {
            $query = $query->withTrashed();
        }
        return $query->find($id, $columns);
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function update($input, $id)
    {
        if (is_array($id)) {
            $query = $this->model->newQuery();
            if (isset($id['where']) && count($id['where'])) {
                foreach ($id['where'] as $where => $value) {
                    $query->where($where, $value);
                }
                $query->update($input);
                return $query;
            }
        } else {
            $query = $this->model->withoutGlobalScopes(['Sales\Scopes\DefaulSalesManScope', 'Sales\Scopes\WithoutColdStateLeads'])->newQuery();
            $model = $query->findOrFail($id);
            $model->fill($input);
            $model->save();
            return $model;
        }
    }

    /**
     * Update Or Create model record for given 2 arrays
     *
     * @param array $input
     * @param array $where
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public
    function updateOrCreate($request, $where)
    {
        $query = $this->model->updateOrCreate($where, $request);
        return $query;
    }

    /**
     * @param int $id
     *
     * @return bool|mixed|null
     * @throws \Exception
     *
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();
        $model = $query->withoutGlobalScopes()->findOrFail($id);
        return $model->delete();
    }

    /**
     * Add Conditions to a Model
     *
     * @param array $conditions
     * @param Model $model
     *
     * @return Model
     * @todo I've to make other condition format like orwhere and where
     *
     */
    public function addConditions(array $conditions, Model $model = null)
    {
        if (!$model) {
            $model = $this->model;
        }
        if ($conditions) {
            foreach ($conditions as $key => $condition) {
                if ($key === "in") {
                    foreach ($condition as $key => $in) {
                        $model->whereIn($key, $in);
                    }
                }
            }
        }
        return $model;
    }

}
