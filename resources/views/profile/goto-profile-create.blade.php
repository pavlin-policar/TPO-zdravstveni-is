@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Niste še zaključili registracije</span>
        <div class="description">Za poln dostop do spletne aplikacije morate dokončati postopek registracije.</div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Zaključi registracijo</div>
                    </div>
                </div>
                <div class="card-body">
                    <p>Za poln dostop do spletne aplikacije morate dokončati postopek registracije.</p>
                    <p>Postopek registracije lahko zaključite tako, da si kreirate profil in izpolnite zahtevane podatke.</p>
                    <div class="text-right">
                        {!! link_to('/logout', 'Izpiši me', ['class' => 'btn btn-default']) !!}
                        {!! link_to_route('profile.getCreate', 'Kreiraj profil', [], ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection