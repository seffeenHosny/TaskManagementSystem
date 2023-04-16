<?php

namespace App\Repositories;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Interfaces\BaseInterface;

class TaskRepository implements BaseInterface
{
    public function index(){
        return Task::with('user')->orderByDesc('id')->paginate(10);
    }

    public function store($request){
        return Task::create($request->validated());
    }

    public function update($request ,$task){
        return $task->update($request->validated());
    }

    public function delete($task){
        return $task->delete();
    }

}
