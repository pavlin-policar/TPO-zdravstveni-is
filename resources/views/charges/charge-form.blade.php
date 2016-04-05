@include('profile.profile-data-form')

<div class="sub-title">Razmerje</div>
{{-- Relationship select box --}}
<div class="form-group{{ $errors->has('relation_id') ? ' has-error' : '' }}">
    {!! Form::label('relation_id', 'Razmerje', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('relation_id', [-1 => 'Izberite možnost'] + $relations, $user->getRelationIdWith(Auth::user()), ['class' => 'form-control', 'required']) !!}
        <span class="help-block">Jaz sem starš | otrok | prijatelj oskrbljencu.</span>
        @if ($errors->has('relation_id'))
            <span class="help-block">{{ $errors->first('relation_id') }}</span>
        @endif
    </div>
</div>