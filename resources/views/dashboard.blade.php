@extends('layouts.master')

@section('content')

    <div class="container-fluid">
        <div class="dashboard-padding-top">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ url('/check/medical') }}">
                        <div class="card red summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-medkit fa-4x"></i>
                                <div class="content">
                                    <div class="title">Zdravila</div>
                                    <div class="sub-title">{{ $checkCountMedical }}</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ url('/check/measurement') }}">
                        <div class="card yellow summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-hospital-o fa-4x"></i>
                                <div class="content">
                                    <div class="title">Meritve</div>
                                    <div class="sub-title">{{ count($checkMeasurement) }}</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ url('/check/disease') }}">
                        <div class="card green summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-plus-square fa-4x"></i>
                                <div class="content">
                                    <div class="title">Bolezni</div>
                                    <div class="sub-title">{{ $checkCountDisease }}</div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{ url('/check/diet') }}">
                        <div class="card blue summary-inline">
                            <div class="card-body">
                                <i class="glyphicon glyphicon-apple fa-4x"></i>
                                <div class="content">
                                    <div class="title">Diete</div>
                                    <div class="sub-title">{{ $checkCountDiet }}</div>
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
                                <a name="HCP">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <div class="title">Vaše izbrano osebje</div>
                                        </div>
                                        <div class="fa fa-compress icon-arrow-right" id="glyphicon-personal"></div>
                                    </div>
                                </a>
                                <div class="card-body no-padding" id="dash-personal">
                                    <h4>Osebni zdravnik:</h4>
                                    <li class="panel panel-default dropdown">
                                        <a data-toggle="collapse" href="#dropdown-element-doctor">
                                            <span class="icon fa fa-user-md"></span>
                                            <span class="title"><strong>{{ $user->doctor !== null ? $user->doctor->fullName : 'Niste si še izbrali osebnega zdravnika' }}</strong></span>
                                        </a>
                                        @if( isset($doctorNurse) )
                                            <div id="dropdown-element-doctor" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <h5>Medicinske sestre:</h5>
                                                    <ul class="nav navbar-nav">
                                                        @foreach ($doctorNurse as $nurse)
                                                            <li><a href="#HCP"> {{ $doctorNurse[$nurse->id]->fullName }} </a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    </li>

                                    <h4>Osebni zobozdravnik:</h4>
                                    <li class="panel panel-default dropdown">
                                        <a data-toggle="collapse" href="#dropdown-element-dentist">
                                            <span class="icon fa fa-user-md"></span>
                                            <span class="title"><strong>{{ $user->dentist !== null ? $user->dentist->fullName : 'Niste si še izbrali osebnega zdravnika' }}</strong></span>
                                        </a>
                                        @if( isset($dentistNurse) )
                                            <div id="dropdown-element-dentist" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <h5>Medicinske sestre:</h5>
                                                    <ul class="nav navbar-nav">
                                                        @foreach ($dentistNurse as $nurse)
                                                            <li><a href="#HCP"> {{ $dentistNurse[$nurse->id]->fullName }} </a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    </li>
                                    <!--
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
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card card-no-padding">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">Vaši pretekli pregledi</div>
                                    </div>
                                    <div class="fa fa-compress icon-arrow-right" id="glyphicon-check-old"></div>
                                </div>
                                <div class="card-body no-padding" id="dash-check-old">
                                    @if(count($checksOld) == 0)
                                    </br>
                                    <p>Do sedaj še niste bili na pregledu.</p>
                                    @else
                                        @for ($x=0; $x < count($checksOld); $x++)
                                            <a href="{{ url('/check', $checksOld[$x]->id) }}">
                                                <table class="table table-hover table-responsive">
                                                    <tr>
                                                        <td>{{ date("d.m.Y H:i",strtotime($checksOld[$x]->time)) }}</td>
                                                        <td>{{ $checksOld[$x]->first_name }} {{ $checksOld[$x]->last_name }}</td>
                                                        <td>{{ $checksOld[$x]->note }}</td>
                                                    </tr>
                                                </table>
                                            </a>
                                        @endfor
                                    @endif
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
                                    @if(count($doctorDates) == 0)
                                        </br>
                                        <p><strong>Niste prijavljeni</strong> na pregled.</p></br>

                                    @else
                                        @foreach ($doctorDates as $doctorDate)
                                            @if($user->isDoctor() || true)
                                                <a href="{{ url('/doctor/check', $doctorDate->id ) }}">
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <td>{{ date("d.m.Y H:i",strtotime($doctorDate->time)) }}</td>
                                                            <td>{{ $doktorCheck[$doctorDate->doctor]->fullName }}</td>
                                                            <td>{{ $doctorDate->note }}</td>
                                                        </tr>
                                                    </table>
                                                </a>
                                            @else
                                                <table class="table table-hover">
                                                    <tr>
                                                        <td>{{ date("d.m.Y H:i",strtotime($doctorDate->time)) }}</td>
                                                        <td>{{ $doktorCheck[$doctorDate->doctor]->fullName }}</td>
                                                        <td>{{ $doctorDate->note }}</td>
                                                    </tr>
                                                </table>
                                            @endif
                                        @endforeach
                                    @endif
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
                                    <table class="table table-hover table-responsive">
                                        @if($checkCountMedical == 0)
                                            <tr>
                                                <td>
                                                    Trenutno ne jemljete zdravil.
                                                </td>
                                            </tr>
                                        @else
                                            <thead>
                                            <tr>
                                                <td>Zdravilo:</td>
                                                <td>Začetek jemanja:</td>
                                                <td>Konec jemanja:</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for ($x=0; $x < count($checkData); $x++)
                                                @if($checkData[$x]->code_type == 14)
                                                    <tr>
                                                        <td>{{ $checkData[$x]->name }}</td>
                                                        <td>{{ date("d.m.Y H:i",strtotime($checkData[$x]->start)) }}</td>
                                                        <td>{{ date("d.m.Y H:i",strtotime($checkData[$x]->end)) }}</td>
                                                    </tr>
                                                @endif
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
                                        @if(count($checkMeasurement) == 0)
                                            <tr>
                                                <td>
                                                    Trenutno nimate meritev.
                                                </td>
                                            </tr>
                                        @else
                                            <thead>
                                            <tr>
                                                <td>Meritev:</td>
                                                <td>Opis:</td>
                                                <td>Datum meritve:</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for ($x=0; $x < count($checkMeasurement); $x++)
                                                <tr>
                                                    <td>{{ $checkMeasurement[$x]->name }}</td>
                                                    <td>{{ $checkMeasurement[$x]->description }}</td>
                                                    <td>{{ date("d.m.Y H:i",strtotime($checkMeasurement[$x]->time)) }}</td>
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
                                    <table class="table table-hover table-responsive">
                                        @if($checkCountDisease == 0)
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
                                            @for ($x=0; $x < count($checkData); $x++)
                                                @if($checkData[$x]->code_type == 13)
                                                    <tr>
                                                        <td>{{ $checkData[$x]->name }}</td>
                                                        <td>{{ date("d.m.Y H:i",strtotime($checkData[$x]->start)) }}</td>
                                                    </tr>
                                                @endif
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
                                    <table class="table table-hover table-responsive">
                                        @if($checkCountDiet == 0)
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
                                                @for ($x=0; $x < count($checkData); $x++)
                                                    @if($checkData[$x]->code_type == 12)
                                                        <tr>
                                                            <td>{{ $checkData[$x]->name }}</td>
                                                            <td>{{ date("d.m.Y H:i",strtotime($checkData[$x]->start)) }}</td>
                                                            @if($checkData[$x]->end == null)
                                                                <td></td>
                                                            @else
                                                            <td>{{ date("d.m.Y H:i",strtotime($checkData[$x]->end)) }}</td>
                                                            @endif
                                                        </tr>
                                                    @endif
                                                @endfor
                                            </tbody>
                                        @endif
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
                                        <div class="fa fa-compress icon-arrow-right" id="glyphicon-patient"></div>
                                    </div>
                                    <div class="card-body no-padding" id="dash-patient">
                                        <table class="table table-hover table-responsive">
                                            <tbody>
                                            @foreach($user->patients as $patient)
                                                {!! link_to_route('dashboard.show', $patient->fullName, $patient->id, ['class' => 'btn btn-default'])!!}&nbsp;
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($user->isDoctor())
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <div class="title title-white">Pregledi</div>
                                        </div>
                                        <div class="fa fa-compress icon-arrow-right" id="glyphicon-doctor-dates"></div>
                                    </div>
                                    <div class="card-body no-padding" id="dash-doctor-dates">
                                        <table class="table table-responsive">
                                            @foreach($allDatesDoctor as $date)
                                                <tr>
                                                    <td class="no-padding">
                                                        <a href="{{ url('/doctor/check', $date->id ) }}">
                                                            <table class="table table-hover no-margin-bottom">
                                                                <tr>
                                                                    <td>{{ date("d.m.Y H:i",strtotime($date->time)) }}</td>
                                                                    <td>{{ $date->first_name }}</td>
                                                                    <td>{{ $date->note }}</td>
                                                                </tr>
                                                            </table>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
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