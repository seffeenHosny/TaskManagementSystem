<?php

namespace App\Services;

use App\Http\Requests\SpecialtyRequest;
use App\Models\Specialty;
use App\Repositories\SpecialtyRepository;

class SpecialtyService
{

    public $repo;

    public function __construct(SpecialtyRepository $repository)
    {
        $this->repo = $repository;
    }

    public function index(){
        return $this->repo->index();
    }

    public function store(SpecialtyRequest $request){
        return $this->repo->store($request);
    }

    public function update(SpecialtyRequest $request ,Specialty $specialty){
        return $this->repo->update($request , $specialty);
    }

    public function delete(Specialty $specialty){
        return $this->repo->delete($specialty);
    }
}
