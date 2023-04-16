<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->middleware('permission:read user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create' , 'store']]);
        $this->middleware('permission:update user', ['only' => ['edit' , 'update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data= $this->service->index();
        return view('users.index',compact('data'));
    }

    public function create(){
        return $this->edit(new User());
    }

    public function store(UserRequest $request){
        $this->service->store($request );
        return  redirect()->route('users.index')->with('success',__('Created'));
    }

    public function edit(User $user){
        $roles = Role::pluck('name' , 'id');
        $role_id = $this->service->getRoleId($user->id)->role_id ?? null;

        return view('users.form' , compact('user' , 'roles' , 'role_id'));
    }

    public function update(UserRequest $request , User $user){
        $this->service->update($request , $user );
        return  redirect()->route('users.index')->with('success',__('Updated'));
    }

    public function destroy(User $user){
        $this->service->delete($user);
        return  redirect()->route('users.index')->with('success',__('Deleted'));
    }

}
