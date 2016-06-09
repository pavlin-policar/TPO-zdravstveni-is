@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="card card-info" data-expanded="1">
                <div class="card yellow card-header">
                    <div class="card-title title-white" style="width:100%">
                        <div class="title pull-left">Diete</div>
                        <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                    </div>
                </div>
                <div class="card-body" id="dash-diet">
                    <table class="datatable table table-striped" cellspacing="0" width="100%">
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
                                <td>{{ date("d.m.Y",strtotime($diets[$x]->start)) }}</td>
                                @if($diets[$x]->end == null)
                                    <td></td>
                                @else
                                    <td>{{ date("d.m.Y",strtotime($diets[$x]->end)) }}</td>
                                @endif
                                <td>{{ $diets[$x]->note }}</td>
                                <td>{{ $diets[$x]->description }}</td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection