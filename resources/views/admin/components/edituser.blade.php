<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">First Name</label>
            <input name="firstname" value="{{ $user->firstname ?? old('firstname') }}" type="text" class="form-control" required>
        </div>
        @error('firstname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Last Name</label>
            <input name="lastname" value="{{ $user->lastname ?? old('lastname') }}" type="text" class="form-control" required>
        </div>
        @error('lastname')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">User Name</label>
            <input name="username" value="{{ $user->username ?? old('username') }}" type="text" class="form-control" required>
        </div>
        @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Full Name</label>
            <input name="fullname" value="{{ $user->fullname ?? old('fullname') }}" type="text" class="form-control" required>
        </div>
        @error('fullname')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Email</label>
            <input name="email" value="{{ $user->email ?? old('email') }}" type="email" class="form-control" required>
        </div>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Another Email</label>
            <input name="other_email" value="{{ $user->other_email ?? old('other_email') }}" type="email" class="form-control" >
        </div>
        @error('other_email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Password</label>
            <input name="password" type="password" class="form-control">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Confirm Password</label>
            <input name="password_confirmation" type="password" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Phone Number</label>
            <input name="phone" value="{{ $user->phone ?? old('phone') }}" type="text" class="form-control" >
        </div>
        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Gender</label>
            <select name="gender" class="form-control">
                <option value="male">Male</option>
                <option value="female">female</option>
            </select>
        </div>
        @error('gender')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Avatar</label>
            <input name="avatar" type="file" class="form-control">
        </div>
        @error('avatar')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>
</div>
