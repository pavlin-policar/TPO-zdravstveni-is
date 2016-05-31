@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">

            @if (Session::has('msg'))
                <div class="alert alert-info fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('msg') }}
                </div>
            @endif

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
                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <td>Meritev:</td>
                                <td>Vrednost:</td>
                                <td>Opis:</td>
                                <td>Datum meritve:</td>
                                <td>Doktor:</td>
                            </tr>
                            </thead>
                            <tbody>
                            @for ($x=0; $x < count($measurements); $x++)
                                <tr>
                                    <td>{!! link_to_route('measurement.edit', $measurements[$x]->name, $measurements[$x]->id)!!}</td>
                                    <td>{!! link_to_route('measurement.edit', $measurements[$x]->result, $measurements[$x]->id)!!}</td>
                                    <td>{!! link_to_route('measurement.edit', $measurements[$x]->description, $measurements[$x]->id)!!}</td>
                                    <td>{!! link_to_route('measurement.edit', date("d.m.Y H:i",strtotime($measurements[$x]->time)), $measurements[$x]->id)!!}</td>
                                    <td>{!! link_to_route('measurement.edit', $measurements[$x]->first_name .' '. $measurements[$x]->last_name, $measurements[$x]->id)!!}</td>
                                </tr>
                            @endfor
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
                            <div class="title title-white">Grafi</div>
                        </div>
                        <div class="fa fa-compress icon-arrow-right" id="glyphicon-medical"></div>
                    </div>
                </a>
                <div class="card-body" id="dash-medical">

                    {!! Form::open(['route' => ['check.measurement'], 'method' => 'get', 'class' => 'form-horizontal']) !!}

                    {{-- Type --}}
                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        {!! Form::label('type', 'Izberite tip meritve', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <select class="form-control select2-hidden-accessible measurementT" required="required" id="measurementType" name="type" tabindex="-1" aria-hidden="true" style="width: 100%">
                                <option value="">Izberite meritev</option>
                                @foreach($codesMeasurement as $m)
                                    @if($typeID == $m->id)
                                        <option selected="selected" value="{{ $m->id }}">{{ $m->name }}</option>
                                    @else
                                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('type'))
                                <span id="checkMeasurementCode" class="help-block">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- From --}}
                    <div class="form-group{{ $errors->has('from') ? ' has-error' : '' }}">
                        {!! Form::label('from', 'Od', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::date('from', $from, ['class' => 'form-control']) !!}
                            @if ($errors->has('from'))
                                <span class="help-block">{{ $errors->first('from') }}</span>
                            @endif
                        </div>
                    </div>
                    {{-- To --}}
                    <div class="form-group{{ $errors->has('to') ? ' has-error' : '' }}">
                        {!! Form::label('to', 'Do', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::date('to', $to, ['class' => 'form-control']) !!}
                            @if ($errors->has('to'))
                                <span class="help-block">{{ $errors->first('to') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            {!! Form::submit('Prikaži graf', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                    @if($graph != null && count($graph) > 0)
                        <div class="hidden">
                            <p id="type">{{ $type }}</p>
                            <p id="graph">{{ $graph }}</p>
                        </div>

                        <div class="row margin-graph">
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <table class="table table-hover padding-bottom padding-top">
                                    <tr>
                                        <td>Meritev </td>
                                        <td>{{ $type->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Opis </td>
                                        <td>{{ $type->description }}</td>
                                    </tr>
                                    <tr>
                                        <td>Minimalna vrednost </td>
                                        <td id="minimal">{{ $type->min_value }}</td>
                                    </tr>
                                    <tr>
                                        <td>Maksimalna vrednost </td>
                                        <td id="maximal">{{ $type->max_value }}</td>
                                    </tr>
                                    <tr>
                                        <td>Normalne vrednosti </td>
                                        <td><b id="minNormal">{{ $normalValues->min_value }}</b> - <b id="maxNormal">{{ $normalValues->max_value }}</b></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-9 col-sm-8 col-xs-12">
                                <div id="graf-meritev"></div>
                            </div>
                        </div>
                    @elseif(count($graph) == 0)
                        <div class="col-sm-8 col-sm-offset-2 margin-graph">
                            <h4>Ni podatkov o tej meritvi!</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection