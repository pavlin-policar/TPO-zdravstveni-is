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
                    <div id="example-2-2" class="pull-right">
                        <input type="submit" class="btn btn-success" id="btn-save" value="Shrani" />
                        {!! link_to_route($back, 'Vrnite se nazaj', [], ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                <div class="card-body">
                    @include('medicalDiseases.medicalTable')
                    {!! Form::open(array('route' => $save)) !!}
                    {{ csrf_field() }}
                    {{ Form::hidden('id', $code->id) }}
                    {{ Form::hidden($postParameter, "") }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection