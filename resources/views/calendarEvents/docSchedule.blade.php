@extends('layouts.master')
@section('content')

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

    <form action="demo_form.asp" method="get">
        VSAK:<br>
        <input type="checkbox" name="vehicle" value="Bike"> PON<br>
        <input type="checkbox" name="vehicle" value="Car" checked> TOR<br>
        <input type="checkbox" name="vehicle" value="Car" checked> SRE<br>
        <input type="checkbox" name="vehicle" value="Car" checked> ČET<br>
        <input type="checkbox" name="vehicle" value="Car" checked> PET<br>

        OD dne: <input type="date" name="dan" value=""><br>
        DO dne: <input type="date" name="dan" value=""><br>
        OD ure: <input type="time" name="dan" value=""><br>
        DO ure: <input type="time" name="dan" value=""><br>
        ČAS termina: <input type="time" name="dan" value=""><br>
        <input type="checkbox" name="vehicle" value="Car" checked> PAVZA OB <input type="time" name="dan" value=""><br>
        <input type="submit" value="Submit">
    </form>

@endsection