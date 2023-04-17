<?php

namespace App\Services;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskService
{

    public $repo;

    public function __construct(TaskRepository $repository)
    {
        $this->repo = $repository;
    }

    public function index(){
        return $this->repo->index();
    }

    public function store(TaskRequest $request){
        return $this->repo->store($request);
    }

    public function update(TaskRequest $request ,Task $task){
        return $this->repo->update($request , $task);
    }

    public function delete(Task $task){
        return $this->repo->delete($task);
    }

    public function updateStatus(Task $task , $status){
        return $this->repo->updateStatus($task , $status);
    }

}
