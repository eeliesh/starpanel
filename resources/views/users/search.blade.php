@extends('layouts.app')

@section('pageTitle', 'Search Results')

@section('content')
    <h2 class="heading"><span class="material-icons">search</span> @yield('pageTitle')</h2>
    <div class="table-wrapper">
        <table class="table" id="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Played Time</th>
                    <th>Registered</th>
                    <th>Last Seen</th>
                </tr>
            </thead>
            <tbody>
                @if (count($players) > 0)
                    @foreach ($players as $player)
                        <tr>
                            <td>
                                <a href="{{ route('users.profile', ['id' => $player->id]) }}">
                                    {{ $player->name }}
                                </a>
                            </td>
                            <td>{{ customTime($player->played_time) }}</td>
                            <td>{{ $player->created_at->diffForHumans() }}</td>
                            <td>{{ $player->updated_at->diffForHumans() }}</td>
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