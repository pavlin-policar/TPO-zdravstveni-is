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
                                <i class="glyphicon glyphicon-apple fa-4x"></i>
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
                                        <div class="title">Vaši prihajajoči pregledi</div>
                                    </div>
                                    <div class="fa fa-compress icon-arrow-right" id="glyphicon-check"></div>
                                </div>
                                <div class="card-body no-padding" id="dash-check">
                                    @if(count($doctorDates) == 0)
                                        </br>
                                        <p><strong>Niste prijavljeni</strong> na pregled.</p></br>
                                        <p>Na pregled se lahko prijavite v spodnjem obrazcu.</p>

                                    @else
                                        <table class="table table-hover">
                                            <tbody>
                                                @foreach ($doctorDates as $doctorDate)
                                                    <tr>
                                                        <td>{{ date("d.m.Y H:i",strtotime($doctorDate->time)) }}</td>
                                                        <td>{{ $doktorCheck[$doctorDate->doctor]->fullName }}</td>
                                                        <td>{{ $doctorDate->note }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
                                        @if(count($checks) == 0)
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Trenutno ne jemljete zdravil
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @else
                                        <thead>
                                            <tr>
                                                <td>Zdravilo:</td>
                                                <td>Začetek jemanja:</td>
                                                <td>Konec jemanja:</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($checkMedical as $medical)
                                            @if(count($medical) > 0 )
                                                <tr>
                                                    <td>{{ $medical[$medical[0]->id]->name }}</td>
                                                    <td>{{ date("d.m.Y H:i",strtotime($medical[0]->start_takeing)) }}</td>
                                                    <td>{{ date("d.m.Y H:i",strtotime($medical[0]->end_takeing)) }}</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>Ni podatkov</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @endif
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
                                        @if(count($measurements) == 0 )
                                            <tr>
                                                <td>
                                                    Trenutno nimate meritev.
                                                </td>
                                            </tr>
                                        @else
                                            <thead>
                                            <tr>
                                                <td>Meritev:</td>
                                                <td>Čas meritve:</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=0; ?>
                                            @foreach ($measurements as $measurement)
                                                <tr>
                                                    <td>{{ $measurement[$measurement->id]->name }}</td>
                                                    <td>{{ date("d.m.Y H:i",strtotime($measurement->time)) }}</td>
                                                </tr>
                                                <?php $i=$i+1; ?>
                                            @endforeach
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
                                            <div class="title title-white">Alergije</div>
                                        </div>
                                        <div class="fa fa-compress icon-arrow-right" id="glyphicon-allergy"></div>
                                    </div>
                                </a>
                                <div class="card-body no-padding" id="dash-allergy">
                                    <table class="table table-hover">
                                        @if(count($checks) == 0 )
                                            <tr>
                                                <td>
                                                    Trenutno nimate alergij.
                                                </td>
                                            </tr>
                                        @else
                                            <thead>
                                                <tr>
                                                    <td>Alergija:</td>
                                                    <td>Odkritje alergije:</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($checkAllergy as $allergy)
                                                    @if(count($allergy) > 0 )
                                                        <tr>
                                                            <td>{{ $allergy[$allergy[0]->id]->name }}</td>
                                                            <td>{{ date("d.m.Y H:i",strtotime($allergy[0]->discovered_at)) }}</td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td>Ni podatkov</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
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
                                        @if(count($checks) == 0)
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
                                                @foreach ($checkDiet as $diet)
                                                    @if(count($diet) > 0 )
                                                        <tr>
                                                            <td>{{ $diet[$diet[0]->id]->name }}</td>
                                                            <td>{{ date("d.m.Y H:i",strtotime($diet[0]->diet_start)) }}</td>
                                                            <td>{{ date("d.m.Y H:i",strtotime($diet[0]->diet_end)) }}</td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td>Ni podatkov</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
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
                                        <div class="fa fa-compress icon-arrow-right" id="glyphicon-diet"></div>
                                    </div>
                                    <div class="card-body no-padding" id="dash-diet">
                                        <table class="table table-hover">
                                            <tbody>
                                            @foreach($user->patients as $patient)
                                                {!! link_to_route('patient.show', $patient->fullName, $patient->id, ['class' => 'btn btn-default'])!!}&nbsp;
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