<div class="sub-title">Pooblastite medicinsko sestro</div>

{!! Form::open(['route' => ['profile.elevateNurse', $user->id], 'method' => 'post', 'class' => 'form-horizontal']) !!}

@include('partials.form-elements.select-nurse')

{{-- Submit button --}}
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Pooblasti', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

{!! Form::close() !!}