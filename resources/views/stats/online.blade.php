@extends('layouts.app')

@section('pageTitle', 'Online Players')

@section('content')
    <h2 class="heading"><span class="material-icons">show_chart</span> @yield('pageTitle') {{ '(' . count($players) . ')' }}</h2>
    <div class="table-wrapper">
        <table class="table" id="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Frags</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($players as $player)
                    <tr>
                        <td>
                            @if (getIdByName($player['Name']))
                                <a href="{{ route('users.profile', ['id' => getIdByName($player['Name'])]) }}">
                                    {{ $player['Name'] }}
                                </a>
                            @else
                                {{ $player['Name'] }}
                            @endif
                        </td>
                        <td>{{ $player['Frags'] }}</td>
                        <td>{{ gmdate('H:i:s', $player['Time']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection