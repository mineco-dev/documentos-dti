@extends('layouts.auth')

@section('title', __('Register'))

@section('content')
<form class="form-signin" method="POST" action="{{ route('register') }}">
    @csrf
    <div class="text-center mb-4">
        <img class="mb-4" src="/images/user-password-icon.png">
        <h1 class="h3 mb-3 font-weight-normal">{{ __('Register') }}</h1>
        <p>{{config('app.name')}}</p>
    </div>

    <div class="form-label-group">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" required autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="name">{{ __('Name') }}</label>
    </div>

    <div class="form-label-group">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="email">{{ __('E-Mail Address') }}</label>
    </div>
    <div class="form-label-group">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="password">{{ __('Password') }}</label>
    </div>
    <div class="form-label-group">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="password-confirm">{{ __('Confirm Password') }}</label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Register') }}</button>
    <p class="mt-5 mb-3 text-muted text-center">
        @if (Route::has('login'))
        <a class="btn btn-link" href="{{ route('login') }}">
            {{ __('Login') }}
        </a>
        @endif
        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
        @endif
    </p>
</form>
@endsection
