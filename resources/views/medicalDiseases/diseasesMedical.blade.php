@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">{{ $code  }}</span>
        <div class="description">{{ $codeDescription  }}</div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    @include('medicalDiseases.medicalTable')
                </div>
            </div>
        </div>
    </div>
@endsection