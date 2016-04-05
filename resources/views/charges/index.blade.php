@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Vaši oskrbljenci</span>
        <div class="description">Pregled nad vsemi osebami, za katere skrbite.
        </div>
    </div>

    <div class="row">
        @foreach($charges as $charge)
            <div class="col-xs-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        {{ $charge->fullName }}
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-xs-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">
                            Dodaj oskrbljenca
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($charges->isEmpty())
                        <p>Trenutno nimate nobenega oskrbljenca.</p>
                    @else
                        <p>Trenutno skrbite za {{ $charges->count() }} oseb.</p>
                    @endif
                    {!! link_to_route('charges.create', 'Dodaj oskrbljenca', [], ['class' => 'btn btn-default']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection