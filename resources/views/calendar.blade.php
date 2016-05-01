@extends('layouts.master')
@section('content')

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    <!-- FullCalendar -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang/sl.js'></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


    <div class="page-title">
        <span class="title">Naročanje</span>
        <div class="description">Naročite se na pregled, tako da kliknete na prazen termin</div>
    </div>

    <div id='calendar'>
        {!! $calendar->calendar() !!}
        {!! $calendar->script() !!}
    </div>

    <style>
        #calendar {
            width: 900px;
        }
    </style>

    <div id="eventContent" title="Event Details", style="display:none;">
        <div id="eventInfo"></div>
        <p><strong><a id="eventLink" target="_blank">Read More</a></strong></p>
    </div>


@endsection