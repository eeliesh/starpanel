@extends('layouts.app')

@section('pageTitle', 'Rcon Control')

@section('content')
    <h2 class="heading"><span class="material-icons">terminal</span> @yield('pageTitle')</h2>
    <form action="#" class="fancy-form" method="POST">
        @csrf

        <div class="grid grid-80-20">
            <div class="form-row">
                <input type="text" name="command" class="form-control">
                <span class="focus-input" data-placeholder="Command"></span>
            </div>

            <div class="btn-group primary">
                <div class="btn-bg"></div>
                <button type="submit" class="btn btn-sm">
                    Submit
                </button>
            </div>
        </div>
    </form>
@endsection