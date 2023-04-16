@extends('layouts.base')
@section('title', __('Users'))
@section('users-active' , 'active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">
                        {{trans('Users')}}
                    </h4>
                </div>
            </div>
            <div class="iq-card-body">
                @can('create user')
                <a href="{{route('users.create')}}" class="btn btn-text-primary font-weight-bold btn-fixed" data-palcement="top" data-toggle="tooltip" title="{{__('Add User')}}">
                    <i class="fa fa-plus"></i>
                </a>
                @endcan
                @if(session()->has('success'))
                    <div class="alert text-white bg-primary" role="alert">
                        <div class="iq-alert-text">{{session()->get('success')}}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                        </button>
                    </div>
                @endif
                <table class="table table-striped table-bordered mt-4 table-hover text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('Role')}}</th>
                        <th>{{__('Actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $index=>$item)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->getRoleNames()[0] ?? ''}}</td>

                                <td class="text-center">
                                    <div class="flex align-items-center list-user-action">
                                        @can('update user')
                                        <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="{{trans('edit')}}" data-original-title="Edit" href="{{route('users.edit' , $item->id)}}">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                        @endcan
                                        @can('delete user')
                                        <a class="iq-bg-primary" href="#" data-toggle="modal" data-target="#delmodel{{$item->id}}">
                                            <i class="ri-delete-bin-line" data-toggle="tooltip" data-placement="top" title="{{trans('delete')}}"></i>
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="delmodel{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="delmodellabel{{$item->id}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delmodelLabel{{$item->id}}">{{__('delete')}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-left">
                                                            {{__('are-you-sure-to delete')}}
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
                                                        {!! Form::open(['method'=>'delete' , 'route'=>['users.destroy' ,$item->id] , 'class'=>'d-inline']) !!}
                                                        <button type="submit" class="btn btn-primary border-0" data-toggle="tooltip"
                                                                data-placement="top" title=""
                                                                data-original-title="{{trans('delete')}}">
                                                                {{trans('delete')}}
                                                        </button>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {!! $data->appends(request()->input())->links() !!}

            </div>

        </div>
    </div>
</div>
@endsection
