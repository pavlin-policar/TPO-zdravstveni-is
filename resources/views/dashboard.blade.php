@extends('layouts.master')

@section('content')

    <div class="container-fluid">
        <div class="dashboard-padding-top">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="#medical">
                        <div class="card red summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-medkit fa-4x"></i>
                                <div class="content">
                                    <div class="title">Zdravila</div>
                                    <div class="sub-title">_</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="#measurment">
                        <div class="card yellow summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-hospital-o fa-4x"></i>
                                <div class="content">
                                    <div class="title">Meritve</div>
                                    <div class="sub-title">_</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="#allergy">
                        <div class="card green summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-plus-square fa-4x"></i>
                                <div class="content">
                                    <div class="title">Alergije</div>
                                    <div class="sub-title">_</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="#diet">
                        <div class="card blue summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-apple fa-4x"></i>
                                <div class="content">
                                    <div class="title">Diete</div>
                                    <div class="sub-title">_</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row  no-margin-bottom">
                <div class="col-sm-6 col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card card-no-padding">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">Osebni podatki pacienta</div>
                                    </div>
                                    <div class="fa fa-compress icon-arrow-right" id="glyphicon-user"></div>
                                </div>
                                <div class="card-body no-padding" id="dash-user">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <td>Ime:</td>
                                            <td>{{ $user->first_name }}</td>

                                        </tr>
                                        <tr>
                                            <td>Priimek:</td>
                                            <td>{{ $user->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Datum rojstva:</td>
                                            <td>{{  date("d.m.Y", strtotime($user->birth_date)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Naslov:</td>
                                            <td>{{ $user->address }}</td>
                                        </tr>
                                        <tr>
                                            <td>Številka kartice:</td>
                                            <td>{{ $user->zz_card_number }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card card-no-padding">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">Vaše izbrano osebje</div>
                                    </div>
                                    <div class="fa fa-compress icon-arrow-right" id="glyphicon-personal"></div>
                                </div>
                                <div class="card-body no-padding" id="dash-personal">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <td>Osebni zdravnik:</td>
                                            <td>{{ $user->doctor !== null ? $user->doctor->fullName : 'Niste si še izbrali osebnega zdravnika' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Osebni zobozdravnik:</td>
                                            <td>{{ $user->dentist !== null ? $user->dentist->fullName : 'Niste si še izbrali osebnega zobozdravnika' }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card card-no-padding">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">Vaši prihajajoči pregledi</div>
                                    </div>
                                    <div class="fa fa-compress icon-arrow-right" id="glyphicon-check"></div>
                                </div>
                                <div class="card-body no-padding" id="dash-check">
                                    <table class="table table-hover">
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card card-no-padding">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">Prijava na pregled</div>
                                    </div>
                                    <div class="fa fa-compress icon-arrow-right" id="glyphicon-add-check"></div>
                                </div>
                                <div class="card-body no-padding" id="dash-add-check">
                                    <div class="sub-title">Izpolnite spodnji obrazec</div>

                                    @include('patients.addCheck')

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
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
                                        <tbody>
                                        <tr>
                                            <td>Ime:</td>
                                            <td>{{ $user->firstName }}</td>

                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        <tbody>
                                        <tr>
                                            <td>Ime:</td>
                                            <td>{{ $user->firstName }}</td>

                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card card-success">
                                <a name="allergy">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <div class="title title-white">Alergije</div>
                                        </div>
                                        <div class="fa fa-compress icon-arrow-right" id="glyphicon-allergy"></div>
                                    </div>
                                </a>
                                <div class="card-body no-padding" id="dash-allergy">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <td>Ime:</td>
                                            <td>{{ $user->firstName }}</td>

                                        </tr>

                                        </tbody>
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
                                        <tbody>
                                        <tr>
                                            <td>Ime:</td>
                                            <td>{{ $user->firstName }}</td>

                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($user->isDoctor())
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <div class="title title-white">PACIENTI</div>
                                        </div>
                                        <div class="fa fa-compress icon-arrow-right" id="glyphicon-diet"></div>
                                    </div>
                                    <div class="card-body no-padding" id="dash-diet">
                                        <table class="table table-hover">
                                            <tbody>
                                            @foreach($user->patients as $patient)
                                                {!! link_to_route('patient.show', $patient->fullName, $patient->id)!!}
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection