<div class="form-group">
    {!! Form::label('code', 'Šifra šifranta') !!}
    {!! Form::text('code', $code['code'], ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Ime šifranta') !!}
    @if(isset($code))
        {!! Form::text('name', $code['name'], ['class' => 'form-control', 'required' => 'required']) !!}
    @else
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    @endif
</div>

<div class="form-group">
    {!! Form::label('description', 'Opis šifranta') !!}
    {!! Form::textarea('description', $code['description'], ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('min_value', 'Minimalna vrednost') !!}
    {!! Form::number('min_value', $code['min_value'], ['class' => 'form-control','step'=>'any']) !!}
</div>

<div class="form-group">
    {!! Form::label('max_value', 'Maksimalna vrednost') !!}
    {!! Form::number('max_value', $code['max_value'], ['class' => 'form-control','step'=>'any']) !!}
</div>
{{ Form::hidden('code_type', $codeTypeID) }}
@if(isset($id))
    {{ Form::hidden('id', $id) }}
@endif