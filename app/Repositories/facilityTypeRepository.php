<?php

namespace App\Repositories;

use App\Http\Requests\facilityTypeRequest;
use App\Models\FacilityType;

class facilityTypeRepository
{
    public function index(){
        return FacilityType::all();
    }

    public function store(facilityTypeRequest $request){
        return FacilityType::create($request->only('name'));
    }

    public function update(facilityTypeRequest $request ,FacilityType $facility_type){
        return $facility_type->update($request->only('name'));
    }

    public function delete(FacilityType $facility_type){
        return $facility_type->delete();
    }

}
