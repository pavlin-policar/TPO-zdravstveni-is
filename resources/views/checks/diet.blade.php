@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="card card-info">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title title-white">Diete</div>
                    </div>
                    <div class="fa fa-compress icon-arrow-right" id="glyphicon-diet"></div>
                </div>
                <div class="card-body no-padding" id="dash-diet">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Dieta: </th>
                                <th>Začetek diete: </th>
                                <th>Konec diete: </th>
                                <th>Opombe: </th>
                                <th>Podatki o dieti: </th>
                            </tr>
                        </thead>
                        <tbody>
                        @for ($x=0; $x < count($diets); $x++)
                            <tr>
                                <td>{{ $diets[$x]->name }}</td>
                                <td>{{ date("d.m.Y H:i",strtotime($diets[$x]->start)) }}</td>
                                @if($diets[$x]->end == null)
                                    <td></td>
                                @else
                                    <td>{{ date("d.m.Y H:i",strtotime($diets[$x]->end)) }}</td>
                                @endif
                                <td>{{ $diets[$x]->note }}</td>
                                <td><a href ='{{ $diets[$x]->description }}' target="_blank">{{ $diets[$x]->description }}</a></td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection