@php
    if(is_null($task->id)){
        $url = route('tasks.store');
        $title = 'Add Task';
        $method = 'POST';
    }else{
        $url = route('tasks.update' , $task->id);
        $title = 'Update Task';
        $method = 'PUT';
    }
@endphp
@extends('layouts.base')
@section('title', __($title))
@section('tasks-active' , 'active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title"> {{__($title)}}</h4>
                </div>
            </div>
            <div class="iq-card-body">

                @include('include.messages')
                <div class="new-user-info">
                    {!! Form::open(['method'=>$method , 'url'=>$url ,'enctype'=>'multipart/form-data']) !!}
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('title' , __('Title')) !!}
                            {!! Form::text('title' , old('title' , $task->title )  ,['class'=>'form-control' , 'id'=>'title' , 'placeholder'=>__('Title')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('user_id' , __('Employee')) !!}
                            {!! Form::select('user_id' , $users ,old('user_id' , $task->user_id )  ,['class'=>'form-control' , 'id'=>'user_id', 'placeholder'=>__('Employee')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('priority' , __('priority')) !!}
                            {!! Form::select('priority' , getEnumValues('tasks' , 'priority') ,old('priority' , $task->priority )  ,['class'=>'form-control' , 'id'=>'priority', 'placeholder'=>__('Priority')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('status' , __('Status')) !!}
                            {!! Form::select('status' , getEnumValues('tasks' , 'status') ,old('status' , $task->status )  ,['class'=>'form-control' , 'id'=>'status', 'placeholder'=>__('Status')]) !!}
                        </div>

                        <div class="form-group col-md-12">
                            {!! Form::label('description' , __('Description')) !!}
                            {!! Form::textarea('description' , old('description' , $task->description )  ,['class'=>'form-control' , 'id'=>'description' , 'placeholder'=>__('Description') , 'rows'=>3]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('due_date' , __('Due Date')) !!}
                            {!! Form::date('due_date' , old('due_date' , $task->due_date )  ,['class'=>'form-control' , 'id'=>'due_date', 'placeholder'=>__('Due Date')]) !!}
                        </div>
                        
                        <div class="col-md-12">
                            {!! Form::submit(__('Save') , ['class'=>'btn btn-primary ml-2 pull-left']) !!}
                            {!! Form::reset(__('Cancel') , ['class'=>'btn btn-secondary pull-left']) !!}
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
