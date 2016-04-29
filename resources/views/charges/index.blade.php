@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Vaši oskrbovanci</span>
        <div class="description">Pregled nad vsemi osebami, za katere skrbite.
        </div>
    </div>

    <div class="row">
        @foreach($charges as $charge)
            <div class="col-xs-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="title">{{ $charge->fullName }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="sub-title">Splošne informacije</div>
                        Zdravstveni podatki
                        <div class="sub-title">Možnosti</div>
                        {!! link_to_route('charges.activate', 'Aktiviraj', [$charge->id], ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('charges.show', 'Pregled profila', [$charge->id], ['class' => 'btn btn-default']) !!}
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">
                            Dodaj oskrbovanca
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($charges->isEmpty())
                        <p>Trenutno nimate nobenega oskrbovanca.</p>
                    @else
                        <p>Trenutno skrbite za {{ $charges->count() }} oseb.</p>
                    @endif
                    {!! link_to_route('charges.create', 'Dodaj oskrbovanca', [], ['class' => 'btn btn-default']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection