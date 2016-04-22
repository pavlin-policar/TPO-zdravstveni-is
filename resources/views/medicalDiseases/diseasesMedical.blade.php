@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">{{ $code->name  }}</span>
        <div class="description">{{ $code->description  }}</div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div id="example-2-2">
                        <p><input type="submit" class="input-button" id="btn-save" value="Shrani" /></p>
                    </div>
                </div>
                <div class="card-body">
                    @include('medicalDiseases.medicalTable')
                    {!! Form::open(array('route' => 'diseases.editMedicalList')) !!}
                    {{ csrf_field() }}
                    {{ Form::hidden('id', $code->id) }}
                    {{ Form::hidden('medicals', "") }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection