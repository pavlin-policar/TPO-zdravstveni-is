@extends('layouts.master')

@section('content')
    <div class="page-title">
        <div class="title">{{ $charge->fullName }}</div>
        <div class="description">Urejanje in pregled oskrbljenčevega profila.</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <span class="title">{{ $charge->fullName }}</span>
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['charges.update', $charge->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

                    @include('profile.profile-data-form', ['user' => $charge])

                    {{-- Submit button --}}
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            {!! Form::submit('Shrani spremembe', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection