@extends('layouts.app')

@section('pageTitle', 'Online Players')

@section('content')
    <h2 class="heading"><span class="material-icons">show_chart</span> @yield('pageTitle') {{ '(' . count($players) . ')' }}</h2>
    <table class="table">
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
                    <td>{{ $player['Name'] }}</td>
                    <td>{{ $player['Frags'] }}</td>
                    <td>{{ gmdate('H:i:s', $player['Time']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection