@extends('layouts.app')

@section('pageTitle', 'Reset Password')

@section('content')
<div class="center-box-container">
    <div class="center-box">
        <h2 class="page-title"><span class="material-icons">lock_reset</span> @yield('pageTitle')</h2>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('password.email') }}" method="POST" class="fancy-form">
            @csrf
    
            <div class="form-row">
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                <span class="focus-input" data-placeholder="{{ __('E-Mail Address') }}"></span>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="btn-group primary">
                <div class="btn-bg"></div>
                <button type="submit" class="btn">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
