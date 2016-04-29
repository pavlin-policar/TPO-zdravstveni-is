@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Šifranti vrste: {{ $codeType->name }}</span>
        <div class="description">{{ $codeType->description }}</div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {!! link_to_route('code.getCreate', 'Dodaj šifrant', ['id' => $codeType->id ], ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('code.index', 'Vrnite se nazaj', [], ['class' => 'btn btn-primary']) !!}
                    </div>

                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Izvozi... <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                        <li>{!! link_to_route('codeTypes.show', 'JSON', array_merge(['code-type' => $codeType->id, 'extension' => '.json'], Request::query())) !!}</li>
                        <li>{!! link_to_route('codeTypes.show', 'PDF', array_merge(['' => $codeType->id, 'extension' => '.pdf'], Request::query())) !!}</li>
                    </ul>
                </div>
                <div class="card-body">
                    @include('code.codeTable')
                </div>
            </div>
        </div>
    </div>
@endsection