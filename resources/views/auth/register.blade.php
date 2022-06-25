@extends('layouts.app')

@section('pageTitle', __('menu.register'))

@section('content')
<div class="center-box-container">
    <div class="center-box">
        <h2 class="page-title"><span class="material-icons">person_add</span> @yield('pageTitle')</h2>
        <form action="{{ route('register') }}" method="POST" class="fancy-form">
            @csrf
    
            <div class="form-row">
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                <span class="focus-input" data-placeholder="{{ __('Name') }}"></span>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
    
            <div class="form-row">
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                <span class="focus-input" data-placeholder="{{ __('E-Mail Address') }}"></span>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
    
            <div class="form-row">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <span class="focus-input" data-placeholder="{{ __('Password') }}"></span>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
    
            <div class="form-row">
                <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autocomplete="new-password">
                <span class="focus-input" data-placeholder="{{ __('Confirm Password') }}"></span>
            </div>
    
            <div class="btn-group primary">
                <div class="btn-bg"></div>
                <button type="submit" class="btn">
                    {{ __('menu.register') }}
                </button>
            </div>

            <div class="help-text">
                <p>
                    Already have an account? <a href="{{ route('login') }}">Login here</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
