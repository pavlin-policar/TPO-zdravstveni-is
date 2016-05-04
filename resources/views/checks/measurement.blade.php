@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <a name="measurment">
                    <div class="card yellow card-header">
                        <div class="card-title">
                            <div class="title title-white">Meritve</div>
                        </div>
                        <div class="fa fa-compress icon-arrow-right" id="glyphicon-measurments"></div>
                    </div>
                </a>
                <div class="card-body no-padding" id="dash-measurments">
                    <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <td>Meritev:</td>
                                <td>Opis:</td>
                                <td>Datum meritve:</td>
                                <td>Doktor:</td>
                            </tr>
                            </thead>
                            <tbody>
                            @for ($x=0; $x < count($measurements); $x++)
                                <tr>
                                    <td>{{ $measurements[$x]->name }}</td>
                                    <td>{{ $measurements[$x]->description }}</td>
                                    <td>{{ date("d.m.Y H:i",strtotime($measurements[$x]->time)) }}</td>
                                    <td>{{ $measurements[$x]->first_name }} {{ $measurements[$x]->last_name }}</td>
                                </tr>
                            @endfor
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection