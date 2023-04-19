<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use App\Services\UserService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $service;
    protected $userService;
    public function __construct(TaskService $service , UserService $userService)
    {
        $this->service = $service;
        $this->userService = $userService;
        $this->middleware('permission:read task', ['only' => ['index']]);
        $this->middleware('permission:create task', ['only' => ['create' , 'store']]);
        $this->middleware('permission:update task', ['only' => ['edit' , 'update']]);
        $this->middleware('permission:delete task', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data= $this->service->index();
        return view('tasks.index',compact('data'));
    }

    public function create(){
        return $this->edit(new Task());
    }

    public function store(TaskRequest $request){
        $this->service->store($request );
        return  redirect()->route('tasks.index')->with('success',__('Created'));
    }

    public function edit(Task $task){
        $users = $this->userService->employees();
        return view('tasks.form' , compact('task' , 'users'));
    }

    public function update(TaskRequest $request , Task $task){
        $this->service->update($request , $task );
        return  redirect()->route('tasks.index')->with('success',__('Updated'));
    }

    public function destroy(Task $task){
        $this->service->delete($task);
        return  redirect()->route('tasks.index')->with('success',__('Deleted'));
    }

    public function start(Task $task){
        $this->service->updateStatus($task , 'In Progress');
        return  redirect()->route('tasks.index')->with('success',__('Updated'));
    }

    public function complete(Task $task){
        $this->service->updateStatus($task , 'Completed');
        return  redirect()->route('tasks.index')->with('success',__('Updated'));
    }

}
