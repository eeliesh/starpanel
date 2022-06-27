@extends('layouts.app')

@section('pageTitle', 'All Players')

@section('content')
    <h2 class="heading"><span class="material-icons">group</span> @yield('pageTitle')</h2>
    {{ $players->links() }}
    <div class="table-wrapper">
        <table class="table" id="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered</th>
                    <th>Last Seen</th>
                    <th>Actions</th>
                </tr>
                <tbody>
                    @if (!empty($players))
                        @foreach ($players as $player)
                            <tr>
                                <td>
                                    <a href="#">
                                        {{ $player->name }}
                                    </a>
                                </td>
                                <td>{{ empty($player->email) ? 'Unset' : $player->email }}</td>
                                <td>{{ $player->created_at }}</td>
                                <td>{{ $player->updated_at }}</td>
                                <td>
                                    <a href="{{ route('owner.player.profile', ['id' => $player->id]) }}" class="btn btn-sm primary">
                                        <span class="material-icons">person</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>No data.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif
                </tbody>
            </thead>
        </table>
    </div>
@endsection