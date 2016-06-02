@extends('layouts.master')

@section('content')

    <div class="container-fluid">
        <div class="dashboard-padding-top" id="dashboard">
            <div class="row">
                <div class="col-xs-12">
                    <div class="card" data-expanded="0">
                        <div class="card-header">
                            <div class="card-title" style="width:100%">
                                <div class="title pull-left">
                                    <span class="fa fa-wrench"></span>&nbsp;Nastative nadzorne
                                    plošče
                                </div>
                                <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => ['api.dashboard.updateLayout', Auth::user()->id], 'method' => 'put', 'id' => 'dashboard-layout-update']) !!}
                            <div class="sub-title">Nastavitev vidnih elementov</div>
                            {{-- Personnel --}}
                            <div class="checkbox">
                                <div class="checkbox3 checkbox-round">
                                    {!! Form::checkbox('dashboard-personnel', true, $settings['dashboard-personnel'], ['id' => 'dashboard-personnel']) !!}
                                    {!! Form::label('dashboard-personnel', 'Zdravniško osebje', ['class' => 'control-label']) !!}
                                </div>
                            </div>
                            {{-- Past checkups --}}
                            <div class="checkbox">
                                <div class="checkbox3 checkbox-round">
                                    {!! Form::checkbox('dashboard-past-checkups', true, $settings['dashboard-past-checkups'], ['id' => 'dashboard-past-checkups']) !!}
                                    {!! Form::label('dashboard-past-checkups', 'Pretekli pregledi', ['class' => 'control-label']) !!}
                                </div>
                            </div>
                            {{-- Future checkups --}}
                            <div class="checkbox">
                                <div class="checkbox3 checkbox-round">
                                    {!! Form::checkbox('dashboard-future-checkups', true, $settings['dashboard-future-checkups'], ['id' => 'dashboard-future-checkups']) !!}
                                    {!! Form::label('dashboard-future-checkups', 'Prihajajoči pregledi', ['class' => 'control-label']) !!}
                                </div>
                            </div>
                            {{-- Medicine --}}
                            <div class="checkbox">
                                <div class="checkbox3 checkbox-round">
                                    {!! Form::checkbox('dashboard-medicine', true, $settings['dashboard-medicine'], ['id' => 'dashboard-medicine']) !!}
                                    {!! Form::label('dashboard-medicine', 'Zdravila', ['class' => 'control-label']) !!}
                                </div>
                            </div>
                            {{-- Measurements --}}
                            <div class="checkbox">
                                <div class="checkbox3 checkbox-round">
                                    {!! Form::checkbox('dashboard-measurements', true, $settings['dashboard-measurements'], ['id' => 'dashboard-measurements']) !!}
                                    {!! Form::label('dashboard-measurements', 'Meritve', ['class' => 'control-label']) !!}
                                </div>
                            </div>
                            {{-- Sickness --}}
                            <div class="checkbox">
                                <div class="checkbox3 checkbox-round">
                                    {!! Form::checkbox('dashboard-sickness', true, $settings['dashboard-sickness'], ['id' => 'dashboard-sickness']) !!}
                                    {!! Form::label('dashboard-sickness', 'Bolezni in alergije', ['class' => 'control-label']) !!}
                                </div>
                            </div>
                            {{-- Diets --}}
                            <div class="checkbox">
                                <div class="checkbox3 checkbox-round">
                                    {!! Form::checkbox('dashboard-diets', true, $settings['dashboard-diets'], ['id' => 'dashboard-diets']) !!}
                                    {!! Form::label('dashboard-diets', 'Diete', ['class' => 'control-label']) !!}
                                </div>
                            </div>

                            <div class="sub-title">Napredno</div>
                            <div class="form-group{{ $errors->has('num_displayed') ? ' has-error' : '' }}">
                                {!! Form::label('num_displayed', 'Št. prikazanih vnosov', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('num_displayed', $settings['num_displayed'], ['class' => 'form-control', 'required']) !!}
                                    <span class="help-block">Število najnovejših vnosov, ki se bodo prikazali na nadzorni plošči v vsakem elementu.</span>
                                    @if ($errors->has('num_displayed'))
                                        <span class="help-block">{{ $errors->first('num_displayed') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="sub-title">Osebne nastavitve</div>
                            {{-- Birth date --}}
                            <div class="checkbox">
                                <div class="checkbox3 checkbox-round">
                                    {!! Form::checkbox('dashboard-birthdate', true, $settings['dashboard-birthdate'], ['id' => 'dashboard-birthdate']) !!}
                                    {!! Form::label('dashboard-birthdate', 'Datum rojstva', ['class' => 'control-label']) !!}
                                </div>
                            </div>
                            {{-- Gender --}}
                            <div class="checkbox">
                                <div class="checkbox3 checkbox-round">
                                    {!! Form::checkbox('dashboard-gender', true, $settings['dashboard-gender'], ['id' => 'dashboard-gender']) !!}
                                    {!! Form::label('dashboard-gender', 'Spol', ['class' => 'control-label']) !!}
                                </div>
                            </div>
                            {{-- Email --}}
                            <div class="checkbox">
                                <div class="checkbox3 checkbox-round">
                                    {!! Form::checkbox('dashboard-email', true, $settings['dashboard-email'], ['id' => 'dashboard-email']) !!}
                                    {!! Form::label('dashboard-email', 'Elektronski naslov', ['class' => 'control-label']) !!}
                                </div>
                            </div>
                            {{-- Telephone --}}
                            <div class="checkbox">
                                <div class="checkbox3 checkbox-round">
                                    {!! Form::checkbox('dashboard-telephone', true, $settings['dashboard-telephone'], ['id' => 'dashboard-telephone']) !!}
                                    {!! Form::label('dashboard-telephone', 'Telefonska številka', ['class' => 'control-label']) !!}
                                </div>
                            </div>
                            {{-- Address --}}
                            <div class="checkbox">
                                <div class="checkbox3 checkbox-round">
                                    {!! Form::checkbox('dashboard-address', true, $settings['dashboard-address'], ['id' => 'dashboard-address']) !!}
                                    {!! Form::label('dashboard-address', 'Naslov', ['class' => 'control-label']) !!}
                                </div>
                            </div>
                            {{-- ZZ Code --}}
                            <div class="checkbox">
                                <div class="checkbox3 checkbox-round">
                                    {!! Form::checkbox('dashboard-zz', true, $settings['dashboard-zz'], ['id' => 'dashboard-zz']) !!}
                                    {!! Form::label('dashboard-zz', 'Številka zdravstvenega zavarovanja', ['class' => 'control-label']) !!}
                                </div>
                            </div>

                            {{-- Submit button --}}
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    {!! Form::submit('Shrani nastavitve', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
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
            <div class="row no-margin-bottom">
                <div class="col-md-6 col-xs-12">
                    <div class="row">
                        @if($user->isDoctor() && session('isMyProfile'))
                            <div class="col-xs-12">
                                <div class="card card-info" data-expanded="1" id="card-appointments">
                                    <div class="card-header">
                                        <div class="card-title title-white" style="width:100%">
                                            <div class="title pull-left">Pregledi</div>
                                            <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                                        </div>
                                    </div>
                                    <div class="card-body no-padding" id="dash-doctor-dates">
                                        <table class="datatable table table-striped" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Datum</th>
                                                <th>Pacient</th>
                                                <th>Opombe</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($allDatesDoctor as $date)
                                                @if($date->patient == $date->doctor)
                                                    <tr>
                                                        <td>{{ date("d.m.Y H:i",strtotime($date->time)) }}</td>
                                                        <td>{{ $date->first_name }} {{ $date->last_name }}</td>
                                                        <td>{{ $date->note }}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>{!! link_to_route('check.doctor', date("d.m.Y H:i",strtotime($date->time)), $date->id)!!}</td>
                                                        <td>{!! link_to_route('check.doctor', $date->first_name .' '. $date->last_name, $date->id)!!}</td>
                                                        <td>{!! link_to_route('check.doctor', $date->note, $date->id)!!}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-xs-12">
                            <div class="card card-no-padding" data-expanded="1" id="card-personal">
                                <div class="card-header">
                                    <div class="card-title" style="width:100%">
                                        <div class="title pull-left">Osebni podatki pacienta</div>
                                        <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                                    </div>
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
                                        @if($settings['dashboard-birthdate'])
                                        <tr>
                                            <td>Datum rojstva:</td>
                                            @if($user->birth_date == null)
                                                <td></td>
                                            @else
                                                <td>{{ date("d.m.Y",strtotime($user->birth_date)) }}</td>
                                            @endif
                                        </tr>
                                        @endif
                                        @if($settings['dashboard-address'])
                                        <tr>
                                            <td>Naslov:</td>
                                            <td>{{ $user->address !== null ? $user->address.', ' : '' }} {{ $user->postCode !== null ? $user->postCode : '' }}</td>
                                        </tr>
                                        @endif
                                        @if($settings['dashboard-telephone'])
                                        <tr>
                                            <td>Telefonska številka:</td>
                                            <td>{{ $user->phone_number }}</td>
                                        </tr>
                                        @endif
                                        @if($settings['dashboard-zz'])
                                        <tr>
                                            <td>Številka kartice:</td>
                                            <td>{{ $user->zz_card_number }}</td>
                                        </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if($settings['dashboard-personnel'])
                        <div class="col-xs-12">
                            <div class="card card-no-padding" data-expanded="1" id="card-personnel">
                                <div class="card-header">
                                    <div class="card-title" style="width:100%">
                                        <div class="title pull-left">Vaše izbrano osebje</div>
                                        <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                                    </div>
                                </div>
                                <div class="card-body no-padding">
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
                                                            <li>
                                                                <a href="#HCP"> {{ $doctorNurse[$nurse->id]->fullName }} </a>
                                                            </li>
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
                                                            <li>
                                                                <a href="#HCP"> {{ $dentistNurse[$nurse->id]->fullName }} </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    </li>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($settings['dashboard-past-checkups'])
                        <div class="col-xs-12">
                            <div class="card card-no-padding" data-expanded="1" id="card-past-checkups">
                                <div class="card-header">
                                    <div class="card-title" style="width:100%">
                                        <div class="title pull-left">Vaši pretekli pregledi</div>
                                        <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                                    </div>
                                </div>
                                <div class="card-body no-padding" id="dash-check-old">
                                    @if(count($checksOld) == 0)
                                    </br>
                                    <p>Do sedaj še niste bili na pregledu.</p>
                                    @else
                                        <table class="table table-hover table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Datum</th>
                                                    <th>Doktor</th>
                                                    <th>Opombe</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @for ($x = 0, $max = count($checksOld); $x < $max; $x++)
                                                <tr class="clickable-link" data-href="{{ url('/check', $checksOld[$x]->id) }}">
                                                    <td>{{ date("d.m.Y H:i",strtotime($checksOld[$x]->time)) }}</td>
                                                    <td>{{ $checksOld[$x]->first_name }} {{ $checksOld[$x]->last_name }}</td>
                                                    <td>{{ $checksOld[$x]->note }}</td>
                                                </tr>
                                            @endfor
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($settings['dashboard-future-checkups'])
                        <div class="col-xs-12">
                            <div class="card card-no-padding" data-expanded="1" id="card-future-checkups">
                                <div class="card-header">
                                    <div class="card-title" style="width:100%">
                                        <div class="title pull-left">Vaši prihajajoči pregledi</div>
                                        <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                                    </div>
                                </div>
                                <div class="card-body no-padding" id="dash-check">
                                    @if(count($doctorDates) == 0)
                                    </br>
                                    <p><strong>Niste prijavljeni</strong> na pregled.</p></br>

                                    @else
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Datum</th>
                                                <th>Doktor</th>
                                                <th>Opombe</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($doctorDates as $doctorDate)
                                                    @if($doctorDate->doctor != $doctorDate->patient)

                                                            <tr>
                                                                <td>{{ date("d.m.Y H:i",strtotime($doctorDate->time)) }}</td>
                                                                <td>{{ $doktorCheck[$doctorDate->doctor]->fullName }}</td>
                                                                <td>{{ $doctorDate->note }}</td>
                                                            </tr>

                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="row">
                        @if($user->isDoctor() && session('isMyProfile'))
                            <div class="col-xs-12">
                                <div class="card card-info" data-expanded="1" id="card-patients">
                                    <div class="card-header">
                                        <div class="card-title title-white" style="width:100%">
                                            <div class="title pull-left">Pacienti</div>
                                            <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                                        </div>
                                    </div>
                                    <div class="card-body no-padding" id="dash-patient">
                                        <table class="datatable table table-striped" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Ime</th>
                                                <th>Priimek</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($user->patients as $patient)
                                                <tr>
                                                    <td>{!! link_to_route('charges.activate', $patient->first_name, $patient->id)!!}</td>
                                                    <td>{!! link_to_route('charges.activate', $patient->last_name, $patient->id)!!}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($user->isDoctor() && session('isMyProfile'))
                            <div class="col-xs-12">
                                <div class="card card-info" data-expanded="1" id="card-patients">
                                    <div class="card-header">
                                        <div class="card-title title-white" style="width:100%">
                                            <div class="title pull-left">Pooblaščeno osebje</div>
                                            <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                                        </div>
                                    </div>
                                    <div class="card-body no-padding" id="dash-patient">
                                        <table class="datatable table table-striped" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Ime</th>
                                                <th>Priimek</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($user->nurses as $nurse)
                                                <tr>
                                                    <td>{!! $nurse->first_name !!} </td>
                                                    <td>{!! $nurse->last_name !!}</td>
                                                    <td>{!! link_to_route('profile.freeNurse', '[Sprostite osebo]', $nurse->id) !!}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($user->isNurse() && session('isMyProfile'))
                            <div class="col-xs-12">
                                <div class="card card-info" data-expanded="1" id="card-patients">
                                    <div class="card-header">
                                        <div class="card-title title-white" style="width:100%">
                                            <div class="title pull-left">Pacienti</div>
                                            <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                                        </div>
                                    </div>
                                    <div class="card-body no-padding" id="dash-patient">
                                        <table class="datatable table table-striped" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Ime</th>
                                                <th>Priimek</th>
                                                <th>Doktor</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($docs as $doctor)
                                                    @foreach($doctor->patients as $patient)
                                                        <tr>
                                                            <td>{!! link_to_route('charges.activate', $patient->first_name, $patient->id)!!}</td>
                                                            <td>{!! link_to_route('charges.activate', $patient->last_name, $patient->id)!!}</td>
                                                            <td>{!! link_to_route('charges.activate', $doctor->fullName, $doctor->id) !!}</td>
                                                        </tr>
                                                    @endforeach
                                            @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($user->isNurse() && session('isMyProfile'))
                            <div class="col-xs-12">
                                <div class="card card-info" data-expanded="1" id="card-patients">
                                    <div class="card-header">
                                        <div class="card-title title-white" style="width:100%">
                                            <div class="title pull-left">Nadrejeni doktorji</div>
                                            <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                                        </div>
                                    </div>
                                    <div class="card-body no-padding" id="dash-patient">
                                        <table class="datatable table table-striped" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Ime</th>
                                                <th>Priimek</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($docs as $doctor)
                                                    <tr>
                                                        <td>{!! link_to_route('charges.activate', $doctor->first_name, $doctor->id)!!}</td>
                                                        <td>{!! link_to_route('charges.activate', $doctor->last_name, $doctor->id)!!}</td>
                                                    </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($settings['dashboard-medicine'])
                        <div class="col-xs-12">
                            <div class="card" data-expanded="1" id="card-medicine">
                                <div class="card red card-header">
                                    <div class="card-title title-white" style="width:100%">
                                        <div class="title pull-left">Zdravila</div>
                                        <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                                    </div>
                                </div>
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
                                                <th>Zdravilo:</th>
                                                <th>Začetek jemanja:</th>
                                                <th>Konec jemanja:</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for ($x=0; $x < count($checkData); $x++)
                                                @if($checkData[$x]->code_type == 14)
                                                    <tr>
                                                        <td>{!! link_to_route('code.publicDetail', $checkData[$x]->name, ['id' => $checkData[$x]->code ]) !!}</td>
                                                        <td>{{ date("d.m.Y",strtotime($checkData[$x]->start)) }}</td>
                                                        @if($checkData[$x]->end == null)
                                                            <td></td>
                                                        @else
                                                            <td>{{ date("d.m.Y",strtotime($checkData[$x]->end)) }}</td>
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
                        @endif
                        @if($settings['dashboard-measurements'])
                        <div class="col-xs-12">
                            <div class="card" data-expanded="1" id="card-measurements">
                                <div class="card yellow card-header">
                                    <div class="card-title title-white" style="width:100%">
                                        <div class="title pull-left">Meritve</div>
                                        <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                                    </div>
                                </div>
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
                                                <th>Meritev:</th>
                                                <th>Vrednost:</th>
                                                <th>Opis:</th>
                                                <th>Datum meritve:</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for ($x=0; $x < count($checkMeasurement); $x++)
                                                <tr>
                                                    <td>{!! link_to_route('measurement.edit', $checkMeasurement[$x]->name, $checkMeasurement[$x]->id)!!}</td>
                                                    <td>{!! link_to_route('measurement.edit', $checkMeasurement[$x]->result, $checkMeasurement[$x]->id)!!}</td>
                                                    <td>{!! link_to_route('measurement.edit', $checkMeasurement[$x]->description, $checkMeasurement[$x]->id)!!}</td>
                                                    <td>{!! link_to_route('measurement.edit', date("d.m.Y H:i",strtotime($checkMeasurement[$x]->time)), $checkMeasurement[$x]->id)!!}</td>
                                                </tr>
                                            @endfor
                                            </tbody>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                            @endif
                            @if($settings['dashboard-sickness'])
                        <div class="col-xs-12">
                            <div class="card card-success" data-expanded="1" id="card-allergies">
                                <div class="card-header">
                                    <div class="card-title title-white" style="width:100%">
                                        <div class="title pull-left">Bolezni in alergije</div>
                                        <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                                    </div>
                                </div>
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
                                                <th>Bolezen ali alergija:</th>
                                                <th>Datum odkritja:</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for ($x=0; $x < count($checkData); $x++)
                                                @if($checkData[$x]->code_type == 13)
                                                    <tr>
                                                        <td>{!! link_to_route('code.publicDetail', $checkData[$x]->name, ['id' => $checkData[$x]->code ]) !!}</td>
                                                        <td>{{ date("d.m.Y",strtotime($checkData[$x]->start)) }}</td>
                                                    </tr>
                                                @endif
                                            @endfor
                                            </tbody>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                            @endif
                            @if($settings['dashboard-diets'])
                        <div class="col-xs-12">
                            <div class="card card-info" data-expanded="1" id="card-diets">
                                <div class="card-header">
                                    <div class="card-title title-white" style="width:100%">
                                        <div class="title pull-left">Diete</div>
                                        <div class="fa fa-compress icon-arrow-right text-right expand-trigger"></div>
                                    </div>
                                </div>
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
                                                <th>Dieta:</th>
                                                <th>Začetek diete:</th>
                                                <th>Konec diete:</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for ($x=0; $x < count($checkData); $x++)
                                                @if($checkData[$x]->code_type == 12)
                                                    <tr>
                                                        <td>{!! link_to_route('code.publicDetail', $checkData[$x]->name, ['id' => $checkData[$x]->code ]) !!}</td>
                                                        <td>{{ date("d.m.Y",strtotime($checkData[$x]->start)) }}</td>
                                                        @if($checkData[$x]->end == null)
                                                            <td></td>
                                                        @else
                                                            <td>{{ date("d.m.Y",strtotime($checkData[$x]->end)) }}</td>
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
                            @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection