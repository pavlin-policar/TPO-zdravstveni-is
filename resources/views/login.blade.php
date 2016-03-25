<!doctype html>
<html>
<head>
    <title>Look at me Login</title>
</head>
<body>

{{ Form::open(array('url' => 'login')) }}
<h1>Login</h1>
@if (isset($errors))
<!-- if there are login errors, show them here -->
<p>
    {{ $errors->first('email') }}
    {{ $errors->first('password') }}
</p>
@endif

<p>
    {{ Form::label('email', 'Email Address') }}
    {{ Form::text('email') }}
</p>

<p>
    {{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}
</p>

<p>{{ Form::submit('Submit!') }}</p>
{{ Form::close() }}