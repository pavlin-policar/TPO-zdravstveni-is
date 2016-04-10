<div class="sub-title">Izberite osebnega zdravnika in zobozdravnika</div>

{!! Form::open(['route' => ['profile.updateDoctors', $user->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

@include('partials.form-elements.select-personal-doctor', ['selectedDoctor' => $user->personal_doctor_id])
@include('partials.form-elements.select-personal-dentist', ['selectedDentist' => $user->personal_dentist_id])

{{-- Submit button --}}
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Shrani spremembe', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

{!! Form::close() !!}