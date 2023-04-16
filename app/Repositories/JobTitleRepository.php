<?php

namespace App\Repositories;

use App\Http\Requests\JobTitleRequest;
use App\Models\JobTitle;

class JobTitleRepository
{
    public function index(){
        return JobTitle::all();
    }

    public function store(JobTitleRequest $request){
        return JobTitle::create($request->only('name'));
    }

    public function update(JobTitleRequest $request ,JobTitle $job_title){
        return $job_title->update($request->only('name'));
    }

    public function delete(JobTitle $job_title){
        return $job_title->delete();
    }

}
