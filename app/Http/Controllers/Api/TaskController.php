<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $service;
    public function __construct(TaskService $service)
    {
        $this->service = $service;
        $this->middleware('permission:read task', ['only' => ['index']]);
        $this->middleware('permission:create task', ['only' => ['create' , 'store']]);
        $this->middleware('permission:update task', ['only' => ['edit' , 'update']]);
        $this->middleware('permission:delete task', ['only' => ['destroy']]);
    }

    public function index()
    {
        $tasks= $this->service->index();

        $paginatedData=getPaginatedData($tasks);
        $paginatedData['items']=TaskResource::collection($tasks);

        return message(true , $paginatedData , null , 200);

    }

    public function store(TaskRequest $request){
        $task = $this->service->store($request );
        return message(true , ['task'=> new TaskResource($task)] , 'Created' , 200);
    }

    public function show(Task $task){
        $task->load('user');
        return message(true , ['task'=> new TaskResource($task)] , null , 200);
    }

    public function update(TaskRequest $request , Task $task){
        $this->service->update($request , $task );
        return message(true , ['task'=> new TaskResource($task)] , 'Updated' , 200);
    }

    public function destroy(Task $task){
        $this->service->delete($task);
        return message(true , [] , 'Deleted' , 200);
    }

    public function start(Task $task){
        $this->service->updateStatus($task , 'In Progress');
        return message(true , ['task'=> new TaskResource($task)] , 'In Progress' , 200);
    }

    public function complete(Task $task){
        $this->service->updateStatus($task , 'Completed');
        return message(true , ['task'=> new TaskResource($task)] , 'Completed' , 200);
    }
}
