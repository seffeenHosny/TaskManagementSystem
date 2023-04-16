@php
    if(is_null($user->id)){
        $url = route('users.store');
        $title = 'Add User';
        $method = 'POST';
    }else{
        $url = route('users.update' , $user->id);
        $title = 'Update User';
        $method = 'PUT';
    }
@endphp
@extends('layouts.base')
@section('title', __($title))
@section('users-active' , 'active')
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
                            {!! Form::label('name' , __('Name')) !!}
                            {!! Form::text('name' , old('name' , $user->name )  ,['class'=>'form-control' , 'id'=>'name' , 'placeholder'=>__('Name')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('email' , __('Email')) !!}
                            {!! Form::email('email' , old('email' , $user->email )  ,['class'=>'form-control' , 'id'=>'email', 'placeholder'=>__('Email')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('role_id' , __('Role')) !!}
                            {!! Form::select('role_id' , $roles , old('role_id' , $role_id)  ,['class'=>'form-control' , 'id'=>'role_id', 'placeholder'=>__('Select Role')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('password' , __('Password')) !!}
                            {!! Form::password('password' ,['class'=>'form-control' , 'id'=>'password', 'placeholder'=>__('Password')]) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('password_confirmation' , __('Password Confirmation')) !!}
                            {!! Form::password('password_confirmation' ,['class'=>'form-control' , 'id'=>'password_confirmation', 'placeholder'=>__('Password Confirmation')]) !!}
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
