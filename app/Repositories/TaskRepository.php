<?php

namespace App\Repositories;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Interfaces\BaseInterface;

class TaskRepository implements BaseInterface
{
    public function index(){
        $tasks = Task::with('user');

        if(!auth()->user()->hasRole('manager')){
            $tasks = $tasks->where('user_id' , auth()->id());
        }
        
        $tasks = $tasks->orderByDesc('id')->paginate(10);

        return $tasks;
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

    public function updateStatus(Task $task , $status){
        if(!auth()->user()->hasRole('manager') && auth()->id() != $task->user_id){
            return abort(403);
        }
        
        return $task->update(['status' => $status]);
    }

}
