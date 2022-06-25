@extends('layouts.app')

@section('pageTitle', $player['name'] . '\'s Profile')

@section('content')
    <div class="profile">
        <div class="grid grid-3">
            <div class="profile__main">
                <h3 class="name">
                    @if (!empty($player->email))
                        <span class="material-icons blue" title="Account created">verified_user</span>
                    @endif
                    @if (!empty($admin))
                        <span class="material-icons red" title="Admin">security</span>
                    @endif
                    {{ $player->name }}
                </h3>
                <div class="avatar">
                    <img src="{{ storage('avatars/default_avatar.png') }}" alt="Default avatar">
                </div>
                @if (isAdmin())
                    <ul class="list-reset admin-controls">
                        <li>
                            <a href="#" class="btn btn-md primary">
                                <span class="material-icons">settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-md info">
                                <span class="material-icons">history</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-md warning">
                                <span class="material-icons">sports_martial_arts</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-md danger">
                                <span class="material-icons">block</span>
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
            <div class="profile__content">
                <div class="user-info">
                    @if (!empty($admin))
                        <div class="user-info__single">
                            <div class="title">Admin Rank</div>
                            <div class="value">{{ $admin_rank }}</div>
                        </div>
                    @endif
                    <div class="user-info__single">
                        <span class="title">Registered</span>
                        <span class="value">{{ $player->created_at }}</span>
                    </div>
                    <div class="user-info__single">
                        <div class="title">Last Seen</div>
                        <div class="value">{{ $player->updated_at }}</div>
                    </div>
                    <div class="user-info__single">
                        <div class="title">Played Time</div>
                        <div class="value">{{ customTime($player->played_time) }}</div>
                    </div>
                    <div class="user-info__single">
                        <div class="title">Kills</div>
                        <div class="value">{{ $player->kills }}</div>
                    </div>
                    <div class="user-info__single">
                        <div class="title">Deaths</div>
                        <div class="value">{{ $player->deaths }}</div>
                    </div>
                    <div class="user-info__single">
                        <div class="title">Headshots</div>
                        <div class="value">{{ $player->headshots }}</div>
                    </div>
                    @if (!empty($player->email) && canAddAdmins())
                        <div class="user-info__single">
                            <div class="title">Email</div>
                            <div class="value">{{ $player->email }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection