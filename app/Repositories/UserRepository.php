<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Models\User;
use BaseInterface;

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

}
