@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form class="mb-2" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>

                    <!--Llamado a url por medio de url
                    <a href="{{ url('login/facebook') }}" class="btn btn-info">
                        Ingresar usando Facebook
                    </a>
                    -->

                    <!--Llamado a url por medio de nombre de url-->
                    <a href="{{ url('login/facebook') }}" class="btn btn-primary btn-block">
                     <ion-icon name="logo-facebook"></ion-icon>
                        Ingresar usando Facebook
                    </a>

                    <a href="#" class="btn btn-info btn-block">
                        <ion-icon name="logo-twitter"></ion-icon>
                        Ingresar usando Twiter
                    </a>

                    <a href="{{ url('login/google') }}" class="btn btn-danger btn-block">
                        <ion-icon name="logo-googleplus"></ion-icon>
                        Ingresar usando Google+
                    </a>

                     <a href="{{ route('register') }}" class="btn btn-dark btn-block">
                        <ion-icon name="mail"></ion-icon>
                        Ingresar mediante correo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
