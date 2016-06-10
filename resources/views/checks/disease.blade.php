@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="card card-success" data-expanded="1">
                <div class="card yellow card-header">
                    <div class="card-title title-white" style="width:100%">
                        <div class="title pull-left">Bolezni in alergije</div>
                        <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                    </div>
                </div>
                <div class="card-body" id="dash-allergy">
                    <table class="datatable table table-striped" cellspacing="0" width="100%">
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
                                <td>{!! link_to_route('code.publicDetail', $diseases[$x]->name, ['id' => $diseases[$x]->code ]) !!}</td>
                                <td>{{ date("d.m.Y",strtotime($diseases[$x]->start)) }}</td>
                                @if($diseases[$x]->end == null)
                                    <td></td>
                                @else
                                    <td>{{ date("d.m.Y",strtotime($diseases[$x]->end)) }}</td>
                                @endif
                                <td>{{ $diseases[$x]->note }}</td>
                                <td>{{ $diseases[$x]->description }}</td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection