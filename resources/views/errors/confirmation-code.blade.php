@extends('layouts.showcase-split-logo')

@section('panel-title')
    <span class="title">Neveljavna aktivacijska koda</span>
@endsection

@section('panel-content')
    <p>Vnesli ste neveljavno aktivacijsko kodo. Kodo ste prejeli na elektronski naslov, ki ste ga vnesli ob registraciji.</p>
    {!! link_to_route('registration.confirm-email', 'Vrni se nazaj', [], ['class' => 'btn btn-default']) !!}
    {!! link_to_route('registration.resend-email', 'Nisem dobil elektronskega sporočila', [], ['class' => 'btn btn-default']) !!}
@endsection
