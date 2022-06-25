@extends('layouts.app')

@section('pageTitle', 'Password Reset')

@section('content')
<div class="auth">
    <h2 class="page-title">@yield('pageTitle')</h2>
    <form action="{{ route('password.update') }}" method="POST" class="form">
        @csrf
        
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-row">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-row">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-row">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('Reset Password') }}
        </button>
    </form>
</div>
@endsection
