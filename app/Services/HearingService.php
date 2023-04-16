<?php

namespace App\Services;

use App\Http\Requests\HearingRequest;
use App\Models\Hearing;
use App\Repositories\HearingRepository;

class HearingService
{

    public $repo;

    public function __construct(HearingRepository $repository)
    {
        $this->repo = $repository;
    }

    public function index(){
        return $this->repo->index();
    }

    public function store(HearingRequest $request){
        return $this->repo->store($request);
    }

    public function update(HearingRequest $request ,Hearing $hearing){
        return $this->repo->update($request , $hearing);
    }

    public function delete(Hearing $hearing){
        return $this->repo->delete($hearing);
    }


}
