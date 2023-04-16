<?php

namespace App\Services;

use App\Repositories\UserRepository;

use Illuminate\Http\Request;

class UserService
{
    public $repo;
    /**
     * Create a new Repository instance.
     *
     * @param  ColorRepository $repository
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        $this->repo = $repository;
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

    /**
     * Use save data into Repository
     *
     * @param Request $request
     * @param Int $id
     * @return Boolean
     */
    public function save(Request $request)
    {
        return $this->repo->save($request);
    }

    public function getOrganizers(Request $request){
        return $this->repo->getOrganizers($request);
    }

}
