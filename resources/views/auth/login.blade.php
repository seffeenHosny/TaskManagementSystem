@extends('auth.auth_layout')
@section('title' ,  __('login'))
@section('content')
<div class="sign-in-from">
    <h1 class="mb-0">{{ __('login') }}</h1>
    @if(session()->has('status'))
        <div class="alert text-white bg-primary" role="alert">
            <div class="iq-alert-text">
                {{session()->get('status')}}
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            x
            </button>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert text-white bg-danger" role="alert">
            <div class="iq-alert-text">
                {{session()->get('error')}}
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            x
            </button>
        </div>
    @endif
    <form class="mt-4" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">{{ __('email') }}</label>
            <input type="email" class="form-control mb-0" id="email" placeholder="{{ __('email') }}" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
            @error('phone')
                <strong>{{ $message }}</strong>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"> {{ __('password') }}</label>
            <a class="float-right forget_password" href="{{ route('password.request') }}">
                {{ __('Forget Password ?') }}
            </a>
            <input type="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="{{ __('password') }}" name="password" required autocomplete="current-password">
            @error('password')
                <strong>{{ $message }}</strong>
            @enderror
        </div>
        <div class="d-inline-block w-100">
            <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                <input type="checkbox" {{ old('remember') ? 'checked' : '' }} name="remember"  class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">{{ __('Remember me') }}</label>
            </div>
            <button type="submit" class="btn btn-primary float-right"> {{ __('login') }}</button>
        </div>
    </form>
</div>
@endsection
