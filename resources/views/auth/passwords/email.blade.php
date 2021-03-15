@extends('layouts.auth')

@section('title', __('Reset Password'))

@section('content')
<form class="form-signin" method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="text-center mb-4">
        <img class="mb-4" src="/images/secrecy-icon.png">
        <h1 class="h3 mb-3 font-weight-normal">{{ __('Reset Password') }}</h1>
        <p>{{config('app.name')}}</p>
    </div>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="form-label-group">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="email">{{ __('E-Mail Address') }}</label>
    </div>

    <button class="btn btn-primary btn-block" type="submit">
        {{ __('Send Password Reset Link') }}
    </button>
    <p class="mt-5 mb-3 text-muted text-center">
        @if (Route::has('login'))
        <a class="btn btn-link" href="{{ route('login') }}">
            {{ __('Login') }}
        </a>
        @endif
        @if (Route::has('register'))
        <a class="btn btn-link" href="{{ route('register') }}">
            {{ __('Register') }}
        </a>
        @endif
    </p>
</form>
@endsection
