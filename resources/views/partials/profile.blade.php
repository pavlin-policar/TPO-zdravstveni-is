@extends('editProfile')

@section('profile')



    <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Ime</label>

        <div class="col-md-6">
            <input type="firstName" @if(isset($user)) value="{{ $user["firstName"] }}" @endif class="form-control" name="firstName">
            @if ($errors->has('firstName'))
                <span class="help-block">
                    <strong>{{ $errors->first('firstName') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Priimek</label>

        <div class="col-md-6">
            <input type="lastName" @if(isset($user)) value="{{ $user["lastName"] }}" @endif class="form-control" name="lastName">
            @if ($errors->has('lastName'))
                <span class="help-block">
                    <strong>{{ $errors->first('lastName') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Naslov</label>

        <div class="col-md-6">
            <input type="address" @if(isset($user)) value="{{ $user["address"] }}" @endif class="form-control" name="address">
            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('post') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Poštna številka</label>

        <div class="col-md-6">
            <input type="post" @if(isset($user)) value="{{ $user["post"] }}" @endif class="form-control" name="post">
            @if ($errors->has('post'))
                <span class="help-block">
                    <strong>{{ $errors->first('post') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Elektronski naslov</label>

        <div class="col-md-6">
            <input type="email" @if(isset($user)) value="{{ $user["email"] }}" @endif class="form-control" name="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('phoneNumber') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Telefonska številka</label>

        <div class="col-md-6">
            <input type="phoneNumber" @if(isset($user)) value="{{ $user["phoneNumber"] }}" @endif class="form-control" name="phoneNumber">
            @if ($errors->has('phoneNumber'))
                <span class="help-block">
                    <strong>{{ $errors->first('phoneNumber') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('ZZCardNumber') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Številka zdravstvenega zavarovanja</label>

        <div class="col-md-6">
            <input type="ZZCardNumber" @if(isset($user)) value="{{ $user["ZZCardNumber"] }}" @endif class="form-control" name="ZZCardNumber">
            @if ($errors->has('ZZCardNumber'))
                <span class="help-block">
                    <strong>{{ $errors->first('ZZCardNumber') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Spol</label>

        <div class="col-md-6">
            <select name="gender" type="gender" class="form-control input-sm">
                <option @if(isset($user->gender) == 0) selected="selected" @endif value="male">male</option>
                <option @if(isset($user->gender) == 1) selected="selected" @endif value="female">female</option>
            </select>
            @if ($errors->has('gender'))
                <span class="help-block">
                    <strong>{{ $errors->first('gender') }}</strong>
                </span>
            @endif
        </div>

    </div>

@endsection

