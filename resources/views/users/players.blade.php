@extends('layouts.app')

@section('pageTitle', 'All Players')

@section('content')
    <h2 class="heading"><span class="material-icons">group</span> @yield('pageTitle') {{ '(' . count($players) . ')' }}</h2>
    {{ $players->links() }}
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Played Time</th>
                    <th>Rank</th>
                    <th>Last Seen</th>
                </tr>
            </thead>
            <tbody>
                @if (count($players) > 0)
                    @foreach ($players as $player)
                        <tr>
                            <td>
                                <a href="{{ route('users.profile', ['id' => $player['id']]) }}">
                                    {{ $player['name'] }}
                                </a>
                            </td>
                            <td>{{ customTime($player['played_time']) }}</td>
                            <td>0</td>
                            <td>{{ $player['updated_at'] }}</td>
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
    </div>
@endsection