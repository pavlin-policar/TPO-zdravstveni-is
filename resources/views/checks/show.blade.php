@extends('layouts.master')

@section('content')
    <div class="row  no-margin-bottom">
        <div class="col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class="card card-no-padding" data-expanded="1">
                        <div class="card white card-header">
                            <div class="card-title title-black" style="width:100%">
                                <div class="title pull-left">Vaš pregled </div>
                                <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                            </div>
                        </div>
                        <div class="card-body no-padding" id="dash-check-old">
                            @if($check == null)
                            </br>
                            <p>Ni podatkov o tem pregledu.</p>
                            @else
                                <table class="table table-hover">
                                    <tr>
                                        <td>Zdravnik: </td>
                                        <td>{{ $check->first_name }} {{ $check->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Datum: </td>
                                        <td>{{ date("d.m.Y H:i",strtotime($check->time)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Opombe: </td>
                                        <td>{{ $check->note }}</td>
                                    </tr>

                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if(count($checkMeasurement) > 0)
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card" data-expanded="1">
                            <div class="card yellow card-header">
                                <div class="card-title title-white" style="width:100%">
                                    <div class="title pull-left">Meritve</div>
                                    <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                                </div>
                            </div>
                            <div class="card-body no-padding" id="dash-measurments">
                                <table class="table table-hover">
                                    @for ($x=0; $x < count($checkMeasurement); $x++)
                                        <tr><td><p></p></td><td><p></p></td></tr>
                                        <tr>
                                            <td>Meritev: </td>
                                            <td>{{ $checkMeasurement[$x]->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Opis: </td>
                                            <td>{{ $checkMeasurement[$x]->description }}</td>
                                        </tr>
                                        <tr>
                                            <td>Podatki: </td>
                                            <td>{{ $checkMeasurement[$x]->result }}</td>
                                        </tr>
                                        <tr>
                                            <td>Datum meritve: </td>
                                            <td>{{ date("d.m.Y H:i",strtotime($checkMeasurement[$x]->time)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Zdravnik: </td>
                                            <td>{{ $checkMeasurement[$x]->first_name }} {{ $checkMeasurement[$x]->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Opombe: </td>
                                            <td>{{ $checkMeasurement[$x]->note }}</td>
                                        </tr>

                                    @endfor
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-sm-6 col-xs-12">
            @if($checkCountMedical > 0)
            <div class="row">
                <div class="col-xs-12">
                    <div class="card" data-expanded="1">
                        <div class="card red card-header">
                            <div class="card-title title-white" style="width:100%">
                                <div class="title pull-left">Zdravila</div>
                                <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                            </div>
                        </div>
                        <div class="card-body no-padding" id="dash-medical">
                            <table class="table table-hover">
                                @for ($x=0; $x < count($checkData); $x++)
                                    @if($checkData[$x]->code_type == 14)
                                        <tr><td><p></p></td><td><p></p></td></tr>
                                        <tr>
                                            <td>Zdravilo: </td>
                                            <td>{!! link_to_route('code.publicDetail', $checkData[$x]->name, ['id' => $checkData[$x]->code ]) !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Začetek jemanja: </td>
                                            <td>{{ date("d.m.Y H:i",strtotime($checkData[$x]->start)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Konec jemanja: </td>
                                            <td>{{ date("d.m.Y H:i",strtotime($checkData[$x]->end)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Opombe: </td>
                                            <td>{{ $checkData[$x]->note }}</td>
                                        </tr>
                                        <tr>
                                            <td>Podatki o zdravilu: </td>
                                            <td><a href ='{{ $checkData[$x]->description }}' target="_blank">{{ $checkData[$x]->description }}</a></td>
                                        </tr>
                                    @endif
                                @endfor
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($checkCountDisease > 0)
            <div class="row">
                <div class="col-xs-12">
                    <div class="card card-success" data-expanded="1">
                        <div class="card card-header">
                            <div class="card-title title-white" style="width:100%">
                                <div class="title pull-left">Bolezni in alergije</div>
                                <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                            </div>
                        </div>
                        <div class="card-body no-padding" id="dash-allergy">
                            <table class="table table-hover">
                                @for ($x=0; $x < count($checkData); $x++)
                                    @if($checkData[$x]->code_type == 13)
                                        <tr><td><p></p></td><td><p></p></td></tr>
                                        <tr>
                                            <td>Bolezen ali alergija: </td>
                                            <td>{!! link_to_route('code.publicDetail', $checkData[$x]->name, ['id' => $checkData[$x]->code ]) !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Pojavitev bolezni ali alergije: </td>
                                            <td>{{ date("d.m.Y H:i",strtotime($checkData[$x]->start)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Izginotje bolezni ali alergije: </td>
                                            @if($checkData[$x]->end == null)
                                                <td></td>
                                            @else
                                                <td>{{ date("d.m.Y H:i",strtotime($checkData[$x]->end)) }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Opombe: </td>
                                            <td>{{ $checkData[$x]->note }}</td>
                                        </tr>
                                        <tr>
                                            <td>Podatki o bolezni ali alergiji: </td>
                                            <td>{{ $checkData[$x]->description }}</td>
                                        </tr>
                                    @endif
                                @endfor
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($checkCountDiet > 0)
            <div class="row">
                <div class="col-xs-12">
                    <div class="card card-info" data-expanded="1">
                        <div class="card card-header">
                            <div class="card-title title-white" style="width:100%">
                                <div class="title pull-left">Diete</div>
                                <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                            </div>
                        </div>
                        <div class="card-body no-padding" id="dash-diet">
                            <table class="table table-hover">
                                @for ($x=0; $x < count($checkData); $x++)
                                    @if($checkData[$x]->code_type == 12)
                                        <tr><td><p></p></td><td><p></p></td></tr>
                                        <tr>
                                            <td>Dieta: </td>
                                            <td>{!! link_to_route('code.publicDetail', $checkData[$x]->name, ['id' => $checkData[$x]->code ]) !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Začetek diete: </td>
                                            <td>{{ date("d.m.Y H:i",strtotime($checkData[$x]->start)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Konec diete: </td>
                                            @if($checkData[$x]->end == null)
                                                <td></td>
                                            @else
                                                <td>{{ date("d.m.Y H:i",strtotime($checkData[$x]->end)) }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Opombe: </td>
                                            <td>{{ $checkData[$x]->note }}</td>
                                        </tr>
                                        <tr>
                                            <td>Podatki o dieti: </td>
                                            <td>{{ $checkData[$x]->description }}</td>
                                        </tr>
                                    @endif
                                @endfor
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

@endsection