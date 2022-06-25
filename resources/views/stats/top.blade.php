@extends('layouts.app')

@section('pageTitle', 'Top Players')

@section('content')
    <h2 class="heading">@yield('pageTitle')</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Kills</th>
                <th>Deaths</th>
                <th>Headshots</th>
                <th>Efficiency</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($players))
                @foreach ($players as $key => $player)
                    <tr>
                        <td>
                            {{ $key + 1 }}
                            @if ($key == 0)
                                <span class="material-icons green">emoji_events</span>
                            @elseif ($key == 1)
                                <span class="material-icons orange">military_tech</span>
                            @elseif ($key == 2)
                                <span class="material-icons blue">star</span>
                            @endif
                        </td>
                        <td>{{ $player->name }}</td>
                        <td>{{ $player->kills }}</td>
                        <td>{{ $player->deaths }}</td>
                        <td>{{ $player->headshots }}</td>
                        <td>
                            @if ($player->deaths == 0 && $player->kills == 0)
                                {{ number_format(100 * $player->kills / ($player->kills + $player->deaths + 1), 2, '.', '') . '%' }}
                            @else
                                {{ number_format(100 * $player->kills / ($player->kills + $player->deaths), 2, '.', '') . '%' }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>No data.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection