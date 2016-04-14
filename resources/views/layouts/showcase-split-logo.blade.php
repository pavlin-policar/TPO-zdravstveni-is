@extends('layouts.showcase')

@section('content')
<div class="row offset-y">
    <div class="col-xs-12 col-md-6 logo-panel">
        <i class="login-logo fa fa-heartbeat fa-5x"></i>
        <h4 class="login-title">Zdravstveni informacijski sistem</h4>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <div class="card-title">
                    @yield('panel-title')</span>
                </div>
            </div>
            <div class="card-body">
                @yield('panel-content')
            </div>
        </div>
    </div>
</div>
@endsection
