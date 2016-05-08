@extends('layouts.master')
@section('content')


    <div class="page-title">
        @can('canDoDoctoryStuff', App\Models\User::class)
            <span class="title">Pregled</span>
            <div class="description">Podatki o pregledu</div>
        @elseif ($creator != null && $creator->who_inserted == Auth::user()->id)
            <span class="title">Pregled</span>
            <div class="description">Podatki o pregledu</div>
        @else
            <div class="page-title">

                <span class="title">Naročanje</span>
                <div class="description">Naročite se na prost termin</div>
            </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <span class="title">Termin: <strong>{!! $time !!}</strong></span><br />
                        @if ($creator == null && $doctor == Auth::user()->id)
                            <span class="title">Upravljalec: <strong>{!! $patient->fullName !!}</strong></span>
                        @else
                            <span class="title">Pacient: <strong>{!! $patient->fullName !!}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @can('canDoDoctoryStuff', App\Models\User::class)
                        <p>Spodaj lahko vnesete nove opombe.</p>
                    @else
                        <p>Prosimo, potrdite rezervacijo termina za pregled.</p>
                    @endcan

                    {!! Form::open(['route' => array('calendar.registerEvent', 'time' => $time, 'user' => $patient, 'doctor' => $doctor), 'method' => 'post', 'class' => 'form-horizontal']) !!}


                    <div class="form-group">
                        {!! Form::label('note', 'Opombe pregleda:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea('note', '', ['class' => 'field']) !!}
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            @if ($creator != null && $creator->who_inserted == Auth::user()->id)
                                {!! Form::submit('Dodaj opombe', ['class' => 'btn btn-primary']) !!}
                                {!! link_to_route('calendar.cancelEvent', 'Sprostite termin', ['time' => $time, 'user' => $patient, 'doctor' => $doctor], ['class' => 'btn btn-primary']) !!}
                            @elseif ($creator != null)
                                @can('canDoDoctoryStuff', App\Models\User::class)
                                    {!! Form::submit('Dodaj opombe', ['class' => 'btn btn-primary']) !!}
                                @endcan
                            @elseif ($creator == null)
                                @if ($doctor == Auth::user()->id)
                                    {!! link_to_route('calendar.cancelEvent', 'Odstranite termin', ['time' => $time, 'user' => $patient, 'doctor' => $doctor], ['class' => 'btn btn-primary']) !!}
                                @else
                                    {!! Form::submit('Rezerviraj termin', ['class' => 'btn btn-primary']) !!}
                                @endif
                            @endif
                        </div>



                    </div>

                    {!! Form::close() !!}
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    @if(Auth::user()->isDoctor())
                        {!! link_to_route('check.doctor', 'Uredi podatke o pregledu', ['date' => $date->id],  ['class' => 'btn btn-primary']) !!}
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection