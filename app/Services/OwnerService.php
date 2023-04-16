<?php

namespace App\Services;

use App\Http\Requests\OwnerRequest;
use App\Models\Owner;
use App\Repositories\OwnerRepository;

class OwnerService
{

    public $repo;

    public function __construct(OwnerRepository $repository)
    {
        $this->repo = $repository;
    }

    public function index(){
        return $this->repo->index();
    }

    public function store(OwnerRequest $request){
        return $this->repo->store($request);
    }

    public function update(OwnerRequest $request ,Owner $owner){
        return $this->repo->update($request , $owner);
    }

    public function delete(Owner $owner){
        return $this->repo->delete($owner);
    }
}
