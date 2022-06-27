@extends('layouts.app')

@section('pageTitle', 'Admins')

@section('content')
    <h2 class="heading"><span class="material-icons">school</span> @yield('pageTitle') {{ '(' . count($admins) . ')' }}</h2>
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Rank</th>
                    <th>Last Seen</th>
                </tr>
            </thead>
            <tbody>
                @if (count($admins) > 0)
                    @foreach ($admins as $admin)
                        <tr>
                            <td>
                                <a href="{{ route('users.profile', ['id' => $admin->user->id]) }}">
                                    {{ $admin->user->name }}
                                </a>
                            </td>
                            <td>
                                @if (array_key_exists($admin->access, $ranks))
                                    {{ $ranks[$admin->access] }}
                                @else
                                    Unknown
                                @endif
                            </td>
                            <td>{{ $admin->user->updated_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>No data.</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection