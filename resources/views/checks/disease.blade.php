@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="card card-success">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title title-white">Bolezni in alergije</div>
                    </div>
                    <div class="fa fa-compress icon-arrow-right" id="glyphicon-allergy"></div>
                </div>
                <div class="card-body no-padding" id="dash-allergy">
                    <table class="table table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>Bolezen ali alergija: </th>
                            <th>Pojavitev bolezni ali alergije: </th>
                            <th>Izginotje bolezni ali alergije: </th>
                            <th>Opombe: </th>
                            <th>Podatki o bolezni ali alergiji: </th>
                        </tr>
                        </thead>
                        <tbody>
                        @for ($x=0; $x < count($diseases); $x++)
                            <tr>
                                <td>{{ $diseases[$x]->name }}</td>
                                <td>{{ date("d.m.Y H:i",strtotime($diseases[$x]->start)) }}</td>
                                <td>{{ date("d.m.Y H:i",strtotime($diseases[$x]->end)) }}</td>
                                <td>{{ $diseases[$x]->note }}</td>
                                <td><a href ='{{ $diseases[$x]->description }}' target="_blank">{{ $diseases[$x]->description }}</a></td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection