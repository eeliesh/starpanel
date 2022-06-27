@extends('layouts.app')

@section('pageTitle', 'Edit Admin ' . $admin->user->name)

@section('content')
    <div class="center-box-container">
        <div class="center-box">
            <h2 class="page-title"><span class="material-icons">manage_accounts</span> @yield('pageTitle')</h2>
            <form action="{{ route('owner.admins.edit', ['id' => $admin->id]) }}" class="fancy-form" method="POST">
                @csrf

                <div class="form-row">
                    <input type="text" name="name" class="form-control" value="{{ $admin->user->name }}">
                    <span class="focus-input" data-placeholder="Username"></span>
                    @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <input type="text" name="auth" class="form-control" value="{{ $admin->auth }}">
                    <span class="focus-input" data-placeholder="Auth"></span>
                    @error('auth')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <input type="text" name="password" class="form-control" value="{{ $admin->password }}">
                    <span class="focus-input" data-placeholder="Password"></span>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <select name="access" class="form-control">
                        @foreach ($ranks as $rank)
                            <option value="{{ $rank->access_flags }}" @if ($rank->access_flags == $admin->access) selected="selected" @endif>{{ $rank->name }}</option>
                        @endforeach
                    </select>
                    <span class="focus-input" data-placeholder="Rank"></span>
                </div>

                <div class="form-row">
                    <select name="flags" class="form-control">
                        @foreach ($allowedFlags as $flag)
                            <option value="{{ $flag }}" @if ($flag == $admin->flags) selected="selected" @endif>{{ $flag }}</option>
                        @endforeach
                    </select>
                    <span class="focus-input" data-placeholder="Flags"></span>
                    @error('flags')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="btn-group primary">
                    <div class="btn-bg"></div>
                    <button type="submit" class="btn">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection