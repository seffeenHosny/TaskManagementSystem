<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Interfaces\BaseInterface;
use App\Models\User;

class UserRepository implements BaseInterface
{
    public function index(){
        return User::orderByDesc('id')->paginate(10);
    }

    public function store($request){
        $data = $request->only('name' , 'email');
        $data['password'] = bcrypt($request->password);
        $user = User::create($request->validated());
        $user->assignRole($request->role_id);
        return $user;
    }

    public function update($request ,$user){
        $data = $request->only('name' , 'email');
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        $user_role = $user->getRoleNames()[0] ?? null;
        if($user_role){
            $user->removeRole($user_role);
        }

        $user->assignRole($request->role_id);

        return $user;
    }

    public function delete($user){
        return $user->delete();
    }

    public function getRoleId($user_id){
        return \DB::table('model_has_roles')->where('model_id' , $user_id)->first();
    }

    public function employees(){
        return User::role('employee')->pluck('name','id');
    }

}
