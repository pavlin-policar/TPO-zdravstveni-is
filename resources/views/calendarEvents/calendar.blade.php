@extends('layouts.master')
@section('content')

    <!-- FullCalendar -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang/sl.js'></script>

    <div class="page-title">
        @if (Auth::user()->id == Session::get('showUser'))
            @can('canDoDoctoryStuff', App\Models\User::class)
                <span class="title">Pregled terminov</span>
                <div class="description">Pregled prostih in zasedenih terminov</div>
                <div class="form-group has-error">
                    <span class="help-block">{!! Session::pull('cloneMessage') !!}</span>
                </div>
                <div class>
                    {!! link_to_route('calendar.schedule', 'Uredite svoj urnik', [], ['class' => 'btn btn-primary']) !!}
                    {!! link_to_route('calendar.cloneWeek', 'Ponovite tekoči teden', [], ['class' => 'btn btn-primary']) !!}
                </div>
                <br />
            @else
                <span class="title">
                    Naročanje</span>
                <div class="description">Naročite se tako, da kliknete na prost termin</div><br />
            @endcan
        @else
            <span class="title">
                Naročanje</span>
            <div class="description">Naročite se tako, da kliknete na prost termin</div><br />
        @endif
    </div>

    <div class="row">
        <div class="card">
            <br />
            <div class="col-sm-3 form-group">
                {!! Form::open(['route' => 'calendar.user', 'method' => 'get', 'class' => 'form-horizontal']) !!}
                <div class="col-sm-10">
                    {!! Form::label('docId', 'Izberite zdravnika:') !!}
                </div>

                <select class="col-sm-1 form-control" name="docId">
                    @if ($doctors->count())
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ $selectedDoc == $doctor->id ? 'selected="selected"' : '' }}>{{ $doctor->fullName }}</option>
                        @endforeach
                    @endif
                </select>

                {{-- Submit button --}}
                <div class="form-group">
                    <div class="col-sm-10">
                        {!! Form::submit('Prikažite zdravnikov koledar', ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('calendar.user', 'Moj urnik', [], ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <br />

    <div id='calendar'>
        {!! $calendar->calendar() !!}
        {!! $calendar->script() !!}
    </div>

    <style>
        #calendar {
            width: 90%;
        }
    </style>
@endsection