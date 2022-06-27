@extends('layouts.app')

@section('pageTitle', 'Owner Panel')

@section('content')
    <h2 class="heading"><span class="material-icons">lock</span> @yield('pageTitle')</h2>
    <div class="block">
        <div class="statistics">
            <h3><span class="material-icons">show_chart</span> Statistics</h3>
            <div class="statistics__content grid grid-4">
                <div class="statistics__single">
                    <div class="statistics__icon">
                        <span class="material-icons">group</span>
                    </div>
                    <div class="statistics__values">
                        <span class="statistics__title">Players</span>
                        <span class="statistics__value">
                            {{ $total_users }}
                        </span>
                    </div>
                </div>
                <div class="statistics__single">
                    <div class="statistics__icon">
                        <span class="material-icons">manage_accounts</span>
                    </div>
                    <div class="statistics__values">
                        <span class="statistics__title">Admins</span>
                        <span class="statistics__value">
                            {{ $total_admins }}
                        </span>
                    </div>
                </div>
                <div class="statistics__single">
                    <div class="statistics__icon">
                        <span class="material-icons">directions_run</span>
                    </div>
                    <div class="statistics__values">
                        <span class="statistics__title">Online Now</span>
                        <span class="statistics__value">
                            {{ $online_players }}
                        </span>
                    </div>
                </div>
                <div class="statistics__single">
                    <div class="statistics__icon">
                        <span class="material-icons">block</span>
                    </div>
                    <div class="statistics__values">
                        <span class="statistics__title">Banned Players</span>
                        <span class="statistics__value">
                            {{ $banned_players }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-70-30">
        <div class="block">
            <h3><span class="material-icons">terminal</span> Rcon Terminal</h3>
            @if (session()->has('rconResponse'))
                <pre>
                    {{ session()->get('rconResponse') }}
                </pre>
            @endif
            <form action="{{ route('owner.rcon.execute') }}" class="fancy-form" method="POST">
                @csrf

                <div class="form-row">
                    <input type="text" name="command" class="form-control">
                    <span class="focus-input" data-placeholder="Command"></span>
                </div>

                <div class="clearfix">
                    <div class="float-right">
                        <div class="w-fit">
                            <div class="btn-group primary">
                                <div class="btn-bg"></div>
                                <button type="submit" name="submit_command" class="btn btn-md"><span class="material-icons">done</span> Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="block">
            <h3><span class="material-icons">construction</span> Quick Menu</h3>
            <ul class="list-reset actions-panel clearfix">
                <li class="actions-panel__item">
                    <span class="material-icons actions-panel__icon">toggle_off</span>
                    <span class="actions-panel__text">Maintenance {{ \App::isDownForMaintenance() ? '(ON)' : '(OFF)' }}</span>
                    <a href="{{ route('owner.maintenance') }}" class="actions-panel__execute">
                        <span class="material-icons">{{ \App::isDownForMaintenance() ? 'close' : 'done' }}</span>
                    </a>
                </li>
                <li class="actions-panel__item clearfix">
                    <span class="material-icons actions-panel__icon">manage_accounts</span>
                    <span class="actions-panel__text">Manage Admins</span>
                    <a href="{{ route('owner.admins.all') }}" class="actions-panel__execute">
                        <span class="material-icons">east</span>
                    </a>
                </li>
                <li class="actions-panel__item clearfix">
                    <span class="material-icons actions-panel__icon">group</span>
                    <span class="actions-panel__text">Manage Players</span>
                    <a href="{{ route('owner.players.all') }}" class="actions-panel__execute">
                        <span class="material-icons">east</span>
                    </a>
                </li>
                <li class="actions-panel__item clearfix">
                    <span class="material-icons actions-panel__icon">history</span>
                    <span class="actions-panel__text">Logs</span>
                    <a href="#" class="actions-panel__execute">
                        <span class="material-icons">east</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endsection