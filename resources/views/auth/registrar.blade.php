@extends('frontend.layout-ls')

@section('title')
    Ecommercer - Registrar cuenta
@endsection
@section('content')
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="{{ asset('frontend/images/login/login.jpg') }}" alt="login image" class="login-img">
            </div>
            <div class="col-sm-6 login-section-wrapper align-items-end">
                <div class="brand-wrapper">
                    <img src="{{ asset('frontend/images/login/logo.svg') }}" alt="logo" class="logo">
                </div>
                <div class="login-wrapper my-auto">
                    <h1 class="login-title text-right">Registrarse</h1>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nombre Completo</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

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
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="ingresa tú contraseña" required autocomplete="new-password">
                            
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="password-confirm">Confirmar contaseña</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="seePassword">
                            <label class="form-check-label" for="seePassword">Ver contraseña</label>
                        </div>

                        <input type="submit" name="login" id="login" class="btn btn-block login-btn" type="button" value="Crear cuenta">
                    </form>
                    
                    <p class="login-wrapper-footer-text">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-reset">Iniciar Sesión</a></p>
                </div>
            </div>            
        </div>
    </div>
</main>

@push('scripts')
<script>
    var password = document.getElementById('password');
    var passConfirm = document.getElementById('password-confirm');
    var seePassword = document.getElementById('seePassword');

    seePassword.addEventListener('click', function(e) {
        if (password.type == 'password') {
            password.type = 'text';
        } else {
            password.type = 'password';
        }

        if(passConfirm.type == 'password') {
            passConfirm.type = 'text';
        } else {
            passConfirm.type = 'password';
        }
    });
</script>
@endpush
@endsection