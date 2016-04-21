@extends('layouts.master')

@section('content')
    <div class="row  no-margin-bottom">
        <div class="col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class="card card-no-padding">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="title">Vaš pregled </div>
                            </div>
                            <div class="fa fa-compress icon-arrow-right" id="glyphicon-check-old"></div>
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
                                        <td>{{ $check->time }}</td>
                                    </tr>

                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
            @if($checkMedical != null)
            <div class="row">
                <div class="col-xs-12">
                    <div class="card">
                        <a name="medical">
                            <div class="card red card-header">
                                <div class="card-title">
                                    <div class="title title-white">Zdravila</div>
                                </div>
                                <div class="fa fa-compress icon-arrow-right" id="glyphicon-medical"></div>
                            </div>
                        </a>
                        <div class="card-body no-padding" id="dash-medical">
                            <table class="table table-hover">
                                @for ($x=0; $x < count($checkMedical); $x++)
                                    <tr>
                                        <td>Zdravilo: </td>
                                        <td>{{ $checkMedical[$x]->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Začetek jemanja: </td>
                                        <td>{{ date("d.m.Y H:i",strtotime($checkMedical[$x]->start_takeing)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Konec jemanja: </td>
                                        <td>{{ date("d.m.Y H:i",strtotime($checkMedical[$x]->end_takeing)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Opombe: </td>
                                        <td>{{ $checkMedical[$x]->note }}</td>
                                    </tr>
                                    <tr>
                                        <td>Podatki o zdravilu: </td>
                                        <td>{{ $checkMedical[$x]->description }}</td>
                                    </tr>

                                @endfor
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($checkMeasurement != null || true)
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
                            <table class="table table-hover">
                                @for ($x=0; $x < count($checkMeasurement); $x++)
                                    <tr>
                                        <td>Meritev: </td>
                                        <td>{{ $checkMeasurement[$x]->name }}</td>
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
            <div class="row">
                <div class="col-xs-12">
                    <div class="card card-success">
                        <a name="allergy">
                            <div class="card-header">
                                <div class="card-title">
                                    <div class="title title-white">Bolezni in alergije</div>
                                </div>
                                <div class="fa fa-compress icon-arrow-right" id="glyphicon-allergy"></div>
                            </div>
                        </a>
                        <div class="card-body no-padding" id="dash-allergy">
                            <table class="table table-hover">
                                @if(count($checkAllergyDisease) == 0)
                                    <tr>
                                        <td>
                                            Trenutno nimate alergije ali bolezni.
                                        </td>
                                    </tr>
                                @else
                                    <thead>
                                    <tr>
                                        <td>Bolezen ali alergija:</td>
                                        <td>Datum odkritja:</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for ($x=0; $x < count($checkAllergyDisease); $x++)
                                        <tr>
                                            <td>{{ $checkAllergyDisease[$x]->name }}</td>
                                            <td>{{ date("d.m.Y H:i",strtotime($checkAllergyDisease[$x]->discovered_at)) }}</td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="card card-info">
                        <a name="diet">
                            <div class="card-header">
                                <div class="card-title">
                                    <div class="title title-white">Diete</div>
                                </div>
                                <div class="fa fa-compress icon-arrow-right" id="glyphicon-diet"></div>
                            </div>
                        </a>
                        <div class="card-body no-padding" id="dash-diet">
                            <table class="table table-hover">
                                @if(count($checkDiet) == 0)
                                    <tr>
                                        <td>
                                            Trenutno niste na dieti
                                        </td>
                                    </tr>
                                @else
                                    <thead>
                                    <tr>
                                        <td>Dieta:</td>
                                        <td>Začetek diete:</td>
                                        <td>Konec diete:</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for ($x=0; $x < count($checkDiet); $x++)
                                        <tr>
                                            <td>{{ $checkDiet[$x]->name }}</td>
                                            <td>{{ date("d.m.Y H:i",strtotime($checkDiet[$x]->diet_start)) }}</td>
                                            <td>{{ date("d.m.Y H:i",strtotime($checkDiet[$x]->diet_end)) }}</td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection