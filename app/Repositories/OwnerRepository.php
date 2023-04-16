<?php

namespace App\Repositories;

use App\Helpers\FileHelper;
use App\Http\Requests\OwnerRequest;
use App\Models\Owner;

class OwnerRepository
{
    public function index(){
        return Owner::all();
    }

    public function store(OwnerRequest $request){
        $data = $request->only('name' , 'title');
        if($request->hasFile('image')){
            $data['image'] = FileHelper::upload_file('owners' , $request->image);
        }
        return Owner::create($data);
    }

    public function update(OwnerRequest $request ,Owner $owner){
        $data = $request->only('name' , 'title');
        if($request->hasFile('image')){
            $data['image'] = FileHelper::upload_file('owners' , $request->image , $owner->image);
        }
        return $owner->update($data);
    }

    public function delete(Owner $owner){
        return $owner->delete();
    }

}
