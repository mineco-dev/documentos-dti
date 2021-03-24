@extends('layouts.auth')

@section('title', __('Login'))

@section('content')
<form action="{{ route('login') }}" class="form-signin" method="POST">
    @csrf
    <div class="text-center mb-4">
        <img class="mb-4" src="/images/user-password-icon.png" alt="">
        <h1 class="h3 mb-3 font-weight-normal">{{ __('Login') }}</h1>
        <p>{{config('app.name')}}</p>
    </div>
    <div class="form-label-group">
        <input aria-describedby="usernameHelpBlock" autocomplete="username" autofocus class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="{{ __('Username') }}" required title="Ejemplo: aejimenez" type="text" value="{{ old('username') }}">
        <small class="form-text text-muted" id="usernameHelpBlock">Ejemplo: aejimenez</small>
        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="username">{{ __('Username') }}</label>
    </div>

    <div class="form-label-group">
        <input autocomplete="current-password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Password" required>

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="password">{{ __('Password') }}</label>
    </div>

    <div class="checkbox mb-3">
        <label for="toggle-view-password" style="display: block;">
            <input id="toggle-view-password"type="checkbox" onclick="toggleViewPassword(event)">
            Mostrar contraseña
        </label>
        <div class="alert alert-info d-none" id="alert">
            Ocultaremos su contraseña en 10 segundos.
        </div>
        <label>
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            {{ __('Remember Me') }}
        </label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Login') }}</button>

    <p class="mt-5 mb-3 text-muted text-center">
        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
        @endif
    </p>
</form>
<script>
    function toggleViewPassword(event) {
        let x = document.getElementById("password");
        let y = document.getElementById("alert");
        
        if (event.target.checked && x.type === "password") {

            y.classList.remove("d-none");
            x.type = "text";

            setTimeout(() => {
                x.type = "password";
                event.target.checked = false;
                y.classList.add("d-none");
            }, 10000)
        } else {
            y.classList.add("d-none");
            x.type = "password";
        }
    }
</script>
@endsection
