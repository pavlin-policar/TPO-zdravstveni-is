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


@endsection