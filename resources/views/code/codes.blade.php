@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Šifranti vrste {{ $codeType  }}</span>
        <div class="description">{{ $codeTypeDescription  }}</div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">

                    <div class="card-title pull-right">
                        {!! link_to_route('code.getCreate', 'Dodaj šifrant', ['id' => $id ], ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('codeType.exportToPDF', 'Izvozi šifrante v PDF', ['id' => $id ], ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('code.index', 'Vrnite se nazaj', [], ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                <div class="card-body">
                    @include('code.codeTable')
                </div>
            </div>
        </div>
    </div>
@endsection