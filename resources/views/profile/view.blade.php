@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">Pregled profila</span>
        <div class="description">
            Tukaj lahko vidite in upravljate z vašimi nastavitvami
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">{{ $user->fullName }}</div>
                    </div>
                </div>
                <div class="card-body no-padding">
                    <div class="step tabs-left card-no-padding">
                        <ul class="nav nav-tabs">
                            <li role="step" class="active">
                                <a href="#personal-info" id="personal-info-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                    <div class="icon fa fa-user"></div>
                                    <div class="step-title">
                                        <div class="title">Osebni podatki</div>
                                        <div class="description">Vaši osebni podatki</div>
                                    </div>
                                </a>
                            </li>
                            <li role="step">
                                <a href="#doctors" id="doctors-tab" role="tab" data-toggle="tab">
                                    <div class="icon fa fa-user-md"></div>
                                    <div class="step-title">
                                        <div class="title">Zdravniško osebje</div>
                                        <div class="description">Kdo skrbi za vas</div>
                                    </div>
                                </a>
                            </li>
                            <li role="step">
                                <a href="#password-reset" id="password-reset-tab" role="tab" data-toggle="tab">
                                    <div class="icon fa fa-key"></div>
                                    <div class="step-title">
                                        <div class="title">Sprememba gesla</div>
                                        <div class="description">Za vašo varnost</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" style="width: 100%">
                            <div class="tab-pane fade in active" id="personal-info" aria-labelledby="personal-info-tab">
                                @include('profile.tabs.profile-info', ['user' => $user])
                            </div>
                            <div class="tab-pane fade" id="doctors" aria-labelledby="doctors-tab">
                                <p>2</p>
                            </div>
                            <div class="tab-pane fade" id="password-reset" aria-labelledby="password-reset-tab">
                                <p>3</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection