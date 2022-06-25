<h3 class="heading">
    <span class="material-icons">badge</span>
    Change Username
</h3>
<form action="{{ route('users.settings.request') }}" class="fancy-form" method="POST">
    @csrf

    <div class="form-row">
        <input type="text" name="new_name" class="form-control" value="{{ old('new_name') }}">
        <span class="focus-input" data-placeholder="New Username"></span>
        @error('new_name')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-row">
        <input type="password" name="confirm_password" class="form-control">
        <span class="focus-input" data-placeholder="Confirm Password"></span>
        @error('confirm_password')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="clearfix">
        <div class="float-right">
            <div class="w-fit">
                <div class="btn-group primary">
                    <div class="btn-bg"></div>
                    <button type="submit" name="change_username" class="btn btn-md">
                        <span class="material-icons">done</span>
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>