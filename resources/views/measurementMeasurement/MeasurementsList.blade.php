@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">{{ $codeType  }}</span>
        <div class="description">{{ $codeTypeDescription  }}</div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    @include('measurementMeasurement.codeTable')
                </div>
            </div>
        </div>
    </div>
@endsection