<?php

namespace App\Services;

use App\Http\Requests\DegreeRequest;
use App\Models\Degree;
use App\Repositories\DegreeRepository;

class DegreeService
{

    public $repo;

    public function __construct(DegreeRepository $repository)
    {
        $this->repo = $repository;
    }

    public function index(){
        return $this->repo->index();
    }

    public function store(DegreeRequest $request){
        return $this->repo->store($request);
    }

    public function update(DegreeRequest $request ,Degree $degree){
        return $this->repo->update($request , $degree);
    }

    public function delete(Degree $degree){
        return $this->repo->delete($degree);
    }
}
