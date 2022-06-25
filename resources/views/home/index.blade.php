@extends('layouts.app')

@section('pageTitle', __('menu.home'))

@section('content')
    <div class="grid grid-70-30">
        <div class="block">
            <h2 class="heading"><span class="material-icons">show_chart</span> Server statistics</h2>
            <div class="server-stats">
                <div class="server-stats__map">
                    <img src="{{ url('storage/maps/' . $server_info['Map'] . '.jpg') }}" alt="{{ $server_info['Map'] }}">
                </div>
                <ul class="server-stats__content list-reset">
                    <li>
                        <div class="server-stats__icon">
                            <span class="material-icons">home</span>
                        </div>
                        <div class="server-stats__info">
                            <span class="server-stats__title">HostName</span>
                            <span class="server-stats__value">
                                {{ $server_info['HostName'] }}
                            </span>
                        </div>
                    </li>
                    <li>
                        <div class="server-stats__icon">
                            <span class="material-icons">near_me</span>
                        </div>
                        <div class="server-stats__info">
                            <span class="server-stats__title">IP Address</span>
                            <span class="server-stats__value">
                                {{ $server_ip . ':' . $server_info['GamePort'] }}
                            </span>
                        </div>
                    </li>
                    <li>
                        <div class="server-stats__icon">
                            <span class="material-icons">sports_esports</span>
                        </div>
                        <div class="server-stats__info">
                            <span class="server-stats__title">Game</span>
                            <span class="server-stats__value">
                                {{ $server_info['ModDesc'] }}
                            </span>
                        </div>
                    </li>
                    <li>
                        <div class="server-stats__icon">
                            <span class="material-icons">map</span>
                        </div>
                        <div class="server-stats__info">
                            <span class="server-stats__title">Map</span>
                            <span class="server-stats__value">
                                {{ $server_info['Map'] }}
                            </span>
                        </div>
                    </li>
                    <li>
                        <div class="server-stats__icon">
                            <span class="material-icons">people</span>
                        </div>
                        <div class="server-stats__info">
                            <span class="server-stats__title">Players</span>
                            <span class="server-stats__value">
                                {{ $server_info['Players'] . ' / ' . $server_info['MaxPlayers'] }}
                            </span>
                        </div>
                    </li>
                    <li>
                        <div class="server-stats__icon">
                            <span class="material-icons">lock</span>
                        </div>
                        <span class="server-stats__info">
                            <span class="server-stats__title">Password Protected</span>
                            <span class="server-stats__value">
                                {{ $server_info['Password'] ? 'Yes' : 'No' }}
                            </span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="block">
            <h2 class="heading"><span class="material-icons">history</span> Staff logs</h2>
            <ul class="staff-logs list-reset">
                <li>
                    <span class="staff-logs__date">
                        [2022-01-01 00:00:00]
                    </span>
                    <span class="staff-logs__text">
                        <strong>Valentin T.</strong> changed <strong>Test</strong>'s rank to <strong>Good</strong>.
                    </span>
                </li>
                <li>
                    <span class="staff-logs__date">
                        [2022-01-01 00:00:00]
                    </span>
                    <span class="staff-logs__text">
                        <strong>Valentin T.</strong> changed <strong>Test</strong>'s rank to <strong>Maresal</strong>.
                    </span>
                </li>
            </ul>
        </div>
    </div>
@endsection