<h3 class="heading">
    <span class="material-icons">pin</span>
    Change Admin Password
</h3>
<form action="{{ route('users.settings.request') }}" class="fancy-form" method="POST">
    @csrf

    <div class="form-row">
        <input type="password" name="account_password" class="form-control" required>
        <span class="focus-input" data-placeholder="Account Password"></span>
        @error('account_password')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-row">
        <input type="password" name="new_password" class="form-control" required>
        <span class="focus-input" data-placeholder="New Password"></span>
        @error('new_password')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-row">
        <input type="password" name="new_password_confirmation" class="form-control" required>
        <span class="focus-input" data-placeholder="Confirm New Password"></span>
        @error('new_password_confirmation')
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
                    <button type="submit" name="change_admin_password" class="btn btn-md">
                        <span class="material-icons">done</span>
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>