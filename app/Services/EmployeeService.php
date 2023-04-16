<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use Auth;
use Illuminate\Http\Request;
class EmployeeService
{

    public $repo;

    /**
     * Create a new Repository instance.
     *
     * @param  ColorRepository $repository
     * @return void
     */
    public function __construct(EmployeeRepository $repository)
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
        return $this->repo->find_by( $request, $relation, $columns, $recursiveRel, $moreConditionForFirstLevel, $orderBy);
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

    public function block($id)
    {
        return $this->repo->block($id);
    }

    public function unblock($id)
    {
        return $this->repo->unblock($id);
    }

    /**
     * Use save data into Repository
     *
     * @param Request $request
     * @param Int $id
     * @return Boolean
     */
    public function save(Request $request, $id = null)
    {

    return $this->repo->save($request, $id);
    }

    public function delete(Request $request, $id = null)
    {
        $delete = $this->repo->mainDelete($request, $id);
        return $delete;
    }

    public function changePassword($id , $old_password, $new_password)
    {
        return $this->repo->changePassword($id , $old_password, $new_password);
    }

    public function updateProfile($request){
        return $this->repo->updateProfile($request);
    }

    public function updateOrganizerProfile(Request $request){
        return $this->repo->updateOrganizerProfile($request);
    }

}
