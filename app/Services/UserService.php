<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{

    public $repo;

    public function __construct(UserRepository $repository)
    {
        $this->repo = $repository;
    }

    public function index(){
        return $this->repo->index();
    }

    public function store(UserRequest $request){
        return $this->repo->store($request);
    }

    public function update(UserRequest $request ,User $user){
        return $this->repo->update($request , $user);
    }

    public function delete(User $user){
        return $this->repo->delete($user);
    }

    public function getRoleId($user_id){
        return $this->repo->getRoleId($user_id);
    }

    public function employees(){
        return $this->repo->employees();
    }
}
