<?php

namespace App\Services;

use App\Repositories\CityRepository;
use Auth;
use Illuminate\Http\Request;
class CityService
{

    public $repo;

    /**
     * Create a new Repository instance.
     *
     * @param CityRepository $repository
     * @return void
     */
    public function __construct(CityRepository $repository)
    {
        $this->repo = $repository;
    }

    /**
     * Use Search Criteria from request to find from Repository
     *
     * @param Request $request
     * @return Collection
     */

    public function find_by(Request $request ,$relation = [], $columns = '*', $recursiveRel = [], $pluck = [], $moreConditionForFirstLevel = [], $orderBy = [])
    {
        return  $this->repo->find_by( $request, $relation, $columns, $recursiveRel, $moreConditionForFirstLevel, $orderBy);

    }

    /**
     * Use id to find from Repository
     *
     * @param Int $id
     * @return Question
     */
    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function delete(Request $request, $id = null)
    {
        return $this->repo->mainDelete($request, $id);
    }


}
