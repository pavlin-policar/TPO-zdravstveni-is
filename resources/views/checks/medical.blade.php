@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="card" data-expanded="1">
                <div class="card yellow card-header">
                    <div class="card-title title-white" style="width:100%">
                        <div class="title pull-left">Zdravila</div>
                        <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                    </div>
                </div>
                <div class="card-body" id="dash-medical">
                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Zdravilo: </th>
                                <th>Začetek jemanja: </th>
                                <th>Konec jemanja: </th>
                                <th>Opombe: </th>
                                <th>Podatki o zdravilu: </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($x=0; $x < count($medicals); $x++)
                                <tr>
                                    <td>{{ $medicals[$x]->name }}</td>
                                    <td>{{ date("d.m.Y H:i",strtotime($medicals[$x]->start)) }}</td>
                                    @if($medicals[$x]->end == null)
                                        <td></td>
                                    @else
                                        <td>{{ date("d.m.Y H:i",strtotime($medicals[$x]->end)) }}</td>
                                    @endif
                                    <td>{{ $medicals[$x]->note }}</td>
                                    <td><a href ='{{ $medicals[$x]->description }}' target="_blank">{{ $medicals[$x]->description }}</a></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection