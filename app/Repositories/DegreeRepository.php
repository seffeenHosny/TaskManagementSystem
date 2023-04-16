<?php

namespace App\Repositories;

use App\Http\Requests\DegreeRequest;
use App\Http\Requests\facilityTypeRequest;
use App\Models\Degree;

class DegreeRepository
{
    public function index(){
        return Degree::all();
    }

    public function store(DegreeRequest $request){
        return Degree::create($request->only('name'));
    }

    public function update(DegreeRequest $request ,Degree $degree){
        return $degree->update($request->only('name'));
    }

    public function delete(Degree $degree){
        return $degree->delete();
    }

}
