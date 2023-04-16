<?php

namespace App\Services;

use App\Http\Requests\facilityTypeRequest;
use App\Models\FacilityType;
use App\Repositories\FacilityTypeRepository;

class facilityTypeService
{

    public $repo;

    public function __construct(FacilityTypeRepository $repository)
    {
        $this->repo = $repository;
    }

    public function index(){
        return $this->repo->index();
    }

    public function store(facilityTypeRequest $request){
        return $this->repo->store($request);
    }

    public function update(facilityTypeRequest $request ,FacilityType $facility_type){
        return $this->repo->update($request , $facility_type);
    }

    public function delete(FacilityType $facility_type){
        return $this->repo->delete($facility_type);
    }
}
