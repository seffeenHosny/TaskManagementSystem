<?php

namespace App\Repositories;

use App\Http\Requests\SpecialtyRequest;
use App\Models\Specialty;

class SpecialtyRepository
{
    public function index(){
        return Specialty::all();
    }

    public function store(SpecialtyRequest $request){
        return Specialty::create($request->only('name' , 'parent_id'));
    }

    public function update(SpecialtyRequest $request ,Specialty $specialty){
        return $specialty->update($request->only('name' , 'parent_id'));
    }

    public function delete(Specialty $specialty){
        return $specialty->delete();
    }

}
