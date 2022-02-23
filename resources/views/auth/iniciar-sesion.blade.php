@extends('frontend.layout-ls')
@section('title')
Ecommerce - Login
@endsection
@section('content')
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 login-section-wrapper">
                <div class="brand-wrapper">
                    <img src="{{ asset('frontend/images/login/logo.svg') }}" alt="logo" class="logo">
                </div>
                <div class="login-wrapper my-auto">
                    <h1 class="login-title">Iniciar Sesión</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Correo Eléctronico</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@example.com" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="ingresa tú contraseña" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="seePassword">
                            <label class="form-check-label" for="seePassword">Ver contraseña</label>
                        </div>

                        <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Recordarme') }}
                            </label>
                        </div>

                        <input type="submit" name="login" id="login" class="btn btn-block login-btn" type="button" value="Iniciar Sesión">
                    </form>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password-link">¿Olvidaste tú contraseña?</a>
                    @endif
                    <p class="login-wrapper-footer-text">¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-reset">Registrate aquí</a></p>
                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="{{ asset('frontend/images/login/login.jpg') }}" alt="login image" class="login-img">
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
    var password = document.getElementById('password');
    var seePassword = document.getElementById('seePassword');

    seePassword.addEventListener('click', function(e) {
        if (password.type == 'password') {
            password.type = 'text';
        } else {
            password.type = 'password';
        }
    });

</script>
@endpush
@endsection
