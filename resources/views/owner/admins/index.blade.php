@extends('layouts.app')

@section('pageTitle', 'Admins')

@section('content')
    <h2 class="heading"><span class="material-icons">group</span> @yield('pageTitle')</h2>
    <div class="secret-actions">
        <a href="{{ route('owner.admins.add') }}" class="btn btn-md success">
            <span class="material-icons">person_add</span>
            Add Admin
        </a>
    </div>
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Auth</th>
            <th>Rank</th>
            <th>Flags</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @if (!empty($admins))
                @foreach ($admins as $admin)
                    <tr>
                        <td>
                            <a href="{{ route('users.profile', ['id' => $admin->user->id]) }}">
                                {{ $admin->user->name }}
                            </a>
                        </td>
                        <td>{{ $admin->auth }}</td>
                        <td>{{ $admin->rank }}</td>
                        <td>{{ $admin->flags }}</td>
                        <td>
                            <a href="{{ route('owner.admins.update', ['id' => $admin->id]) }}" class="btn btn-sm primary">
                                <span class="material-icons">edit</span>
                            </a>
                            <a href="#" class="btn btn-sm danger">
                                <span class="material-icons">clear</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <td>No data.</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            @endif
        </tbody>
    </table>
@endsection