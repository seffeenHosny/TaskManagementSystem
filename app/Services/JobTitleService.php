<?php

namespace App\Services;

use App\Http\Requests\JobTitleRequest;
use App\Models\JobTitle;
use App\Repositories\JobTitleRepository;

class JobTitleService
{

    public $repo;

    public function __construct(JobTitleRepository $repository)
    {
        $this->repo = $repository;
    }

    public function index(){
        return $this->repo->index();
    }

    public function store(JobTitleRequest $request){
        return $this->repo->store($request);
    }

    public function update(JobTitleRequest $request ,JobTitle $job_title){
        return $this->repo->update($request , $job_title);
    }

    public function delete(JobTitle $job_title){
        return $this->repo->delete($job_title);
    }
}
