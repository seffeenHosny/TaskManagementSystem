@extends('dashboard.auth.auth_layout')
@section('title' , __('admin.update_password')
)@section('content')
<div class="sign-in-from">
    <h1 class="mb-0">{{ __('admin.update_password') }}</h1>
    @if($errors->any())
    <div class="alert text-white bg-danger" role="alert">
        @foreach($errors->all() as $error)
            <div class="iq-alert-text">
                {{$error}}
            </div>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        x
        </button>
    </div>
    @endif
    <form class="mt-4" method="post" action="{{ route('password.confirm') }}">
        @csrf
        <div class="form-group">
            <label for="password">{{ __('admin.password') }}</label>
            <input id="password" type="password" class="form-control mb-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm">{{ __('admin.con-password') }}</label>
            <input id="password-confirm" type="password" class="form-control mb-0" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-left">
                {{ __('admin.save') }}
            </button>
        </div>
    </form>
</div>
@endsection



@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
