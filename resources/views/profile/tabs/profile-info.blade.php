{!! Form::open(['route' => ['profile.updatePersonal', $user->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

@include('profile.profile-data-form')

{{-- Submit button --}}
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Shrani spremembe', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

{!! Form::close() !!}