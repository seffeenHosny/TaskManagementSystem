<?php

namespace App\Repositories;

use App\Http\Requests\HearingRequest;
use App\Models\Hearing;

class HearingRepository
{
    public function index(){
        return Hearing::all();
    }

    public function store(HearingRequest $request){
        return Hearing::create($request->only('description'));
    }

    public function update(HearingRequest $request ,Hearing $hearing){
        return $hearing->update($request->only('description'));
    }

    public function delete(Hearing $hearing){
        return $hearing->delete();
    }

}
