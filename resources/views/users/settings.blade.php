@extends('layouts.app')

@section('pageTitle', 'Profile Settings')

@section('content')
    <h2 class="heading"><span class="material-icons">manage_accounts</span> @yield('pageTitle')</h2>
    <div class="tabs">
        <ul class="list-reset tabs__menu">
            <li class="tabs__menu-item">
                <a href="{{ route('users.settings') }}" class="tabs__menu-link{{ $active_page == 'overview' ? ' active' : '' }}">
                    <span class="material-icons">dashboard</span>
                    Overview
                </a>
            </li>
            <li class="tabs__menu-item">
                <a href="{{ route('users.settings.username') }}" class="tabs__menu-link{{ $active_page == 'username' ? ' active' : '' }}">
                    <span class="material-icons">badge</span>
                    Username
                </a>
            </li>
            <li class="tabs__menu-item">
                <a href="{{ route('users.settings.email') }}" class="tabs__menu-link{{ $active_page == 'email' ? ' active' : '' }}">
                    <span class="material-icons">email</span>
                    Account Email
                </a>
            </li>
            <li class="tabs__menu-item">
                <a href="{{ route('users.settings.password') }}" class="tabs__menu-link{{ $active_page == 'password' ? ' active' : '' }}">
                    <span class="material-icons">password</span>
                    Account Password
                </a>
            </li>
            @if (isAdmin())
                <li class="tabs__menu-item">
                    <a href="{{ route('users.settings.admin') }}" class="tabs__menu-link{{ $active_page == 'admin' ? ' active' : '' }}">
                        <span class="material-icons">pin</span>
                        Admin Password
                    </a>
                </li>
            @endif
        </ul>
        <div class="tabs__content">
            @switch($active_page)
                @case('username')
                    @include('users.includes.username')
                    @break
                
                @case('email')
                    @include('users.includes.email')
                    @break

                @case('password')
                    @include('users.includes.password')
                    @break
                
                @case('admin')
                    @include('users.includes.admin')
                    @break
            
                @default
                    @include('users.includes.overview')
            @endswitch
        </div>
    </div>
@endsection