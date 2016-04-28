@extends('layouts.showcase-split-logo')

@section('panel-title')
    <span class="title">Izbris uspešen</span>
@endsection

@section('panel-content')
    <p>Uspešno ste izbrisali svoj uporabniški račun. Če boste želeli v prihodnosti znova uporabljati našo storitev, kontaktirajte admisitratorja informacijskega sistema.</p>
    {!! link_to('/', 'Na začetno stran', ['class' => 'btn btn-default']) !!}
@endsection
