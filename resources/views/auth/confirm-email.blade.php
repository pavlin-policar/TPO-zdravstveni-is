@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Aktiviraj račun</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('registration.do-confirm-email') }}">

                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('confirmationCode') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label" for="confirmationCode">Aktivacijska koda</label>
                                <div class="col-md-6">
                                    <input type="confirmationCode" class="form-control" name="confirmationCode" id="confirmationCode" placeholder="Aktivacijska koda">
                                    @if ($errors->has('confirmationCode'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('confirmationCode') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Aktiviraj račun
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
