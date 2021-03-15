@extends('layouts.auth')

@section('title', __('Reset Password'))

@section('content')
<form class="form-signin" method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="text-center mb-4">
        <img class="mb-4" src="/images/secrecy-icon.png">
        <h1 class="h3 mb-3 font-weight-normal">{{ __('Reset Password') }}</h1>
        <p>{{config('app.name')}}</p>
    </div>
    <div class="form-label-group">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="email">{{ __('E-Mail Address') }}</label>
    </div>

    <div class="form-label-group">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="{{ __('Password') }}" required autofocus>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="password">{{ __('Password') }}</label>
    </div>

    <div class="form-label-group">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="{{ __('Confirm Password') }}" required>
        <label for="password-confirm">{{ __('Confirm Password') }}</label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Reset Password') }}</button>
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
